// Viết mã JS tại đây
function Validator(option){
    function getParent(element,selector){
        while(element.parentElement){
            if(element.parentElement.matches(selector)){
                return element.parentElement
            }
            else {
                element=element.parentElement
            }
        }
    }
    function validate(inputElement,rule){
        const errorElement=option?.errorElement ? getParent(inputElement,'.form-group').querySelector(option.errorElement): ""
        var messErorr
        var rules=selectorRules[rule.selector]
        for(var i=0;i<rules.length;i++){
            switch (inputElement.type){
                case 'radio':
                case 'checkbox':
                    messErorr=rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    )
                    break
                default: messErorr=rules[i](inputElement.value)
            }
            if(messErorr){
                break
            }
        }
        if(messErorr){
            errorElement.innerHTML=messErorr;
            getParent(inputElement,'.form-group').classList.add('invalid')
        }
        else {
            getParent(inputElement,'.form-group').classList.remove('invalid')
            option?.errorElement ? errorElement.innerHTML="": "";
        }
        return messErorr
    }
    function activeInput(inputElement,rule){
        var messErorr
        var rules=selectorRules[rule.selector]
        for(var i=0;i<rules.length;i++){
            switch (inputElement?.type){
                case 'radio':
                case 'checkbox':
                    messErorr=rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    )
                    break
                default: messErorr=rules[i](inputElement.value)
            }
            if(messErorr){
                break
            }
        }
        return !messErorr
    }
    var formElement=document.querySelector(option.form)
    function enableSubmit(){
        var isFormValid=true
        const btnSubElement=formElement.querySelector('.btn-login');
        option.rules.forEach((rule) =>{
            var inputElement=formElement.querySelector(rule.selector)   
            var isValid=activeInput(inputElement,rule)
            if(!isValid){
                isFormValid=false
            }
        })
        if(isFormValid){
            btnSubElement?.classList.remove('btn-default');
        }
        else
            btnSubElement?.classList.add('btn-default');
        return isFormValid;
    }
    if(formElement){
        //Khi submit form
        formElement.onsubmit=function(e){
            
            e.preventDefault()
            var isFormValid=enableSubmit()
            if(isFormValid){
                // Submit bằng js
                
                if(typeof option.onSubmit === 'function'){
                    var enableInput=formElement.querySelectorAll('[name]')
                    var valueForm=Array.from(enableInput).reduce((value,input) =>{
                        switch (input?.type){
                            case 'radio':
                                value[input.name]=formElement.querySelector('input[name="' +input.name+'"]:checked').value
                                break
                            case 'checkbox':
                                if(!input.matches(':checked')) {
                                    value[input.name]=''
                                    return value
                                }
                                if(!Array.isArray(value[input.name])){
                                    value[input.name]=[]
                                }
                                value[input.name].push(input.value)
                                break
                            case 'file':
                                value[input.name]=input.files
                                break
                            default: value[input.name]=input.value
                                
                        }
                        return value
                    },{})
                    option.onSubmit(valueForm)
                }
                // Submit mặc định của gg
                else {
                    formElement.submit()
                }
            }
        }
        var selectorRules={}
        option.rules.forEach((rule,index) =>{
            //Lưu lại các rule cho từng input
            if(Array.isArray(selectorRules[rule.selector])){
                selectorRules[rule.selector].push(rule.test)
            }
            else {
                selectorRules[rule.selector]=[rule.test]
            }
            var inputElements=formElement.querySelectorAll(rule.selector)   
            Array.from(inputElements).forEach((inputElement) =>{
                inputElement.addEventListener('input', function() {
                    enableSubmit()
                    if(option?.errorElement){
                        const errorElement=getParent(inputElement,'.form-group').querySelector(option?.errorElement)
                        errorElement.innerText=''
                    }
                    getParent(inputElement,'.form-group').classList.remove('invalid')
                    // validate(inputElement, rule);
                });
                
                inputElement.addEventListener('blur', function() {
                    validate(inputElement, rule);
                });
                // inputElement.oninput=function(){                    
                //     enableSubmit()
                    
                // }
            })
            
        })
    }
}
Validator.isRequired=function(selector){
    return {
        selector,
        test: (value)=>(
            value ? undefined: 'Vui lòng nhập trường này'
        )
    }
}
Validator.isEmail=function(selector){
    return {
        selector,
        test: function(value){
            const regex=/[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
            return regex.test(value) ? undefined : 'Email không hợp lệ'
        }
    }
}
Validator.isMinLength=function(selector,min){
    return {
        selector,
        test: function(value){
            return value.length >=min ? undefined : `Phải nhập ít nhất ${min} ký tự`
        }
    }
}
Validator.isMaxLength=function(selector,max){
    return {
        selector,
        test: function(value){
            return value.length <=max ? undefined : `Nhập tối đa ${max} ký tự`
        }
    }
}
Validator.isConfirmed=function(selector,valueConfirm){
    return {
        selector,
        test: function(value){
            return value == valueConfirm()? undefined : 'Xác nhận mật khẩu chưa đúng'
        }
    }
}
Validator.isNumber=function(selector){
    return {
        selector,
        test: function(value){
            return !isNaN(value)? undefined : 'Ký tự nhập phải là số'
        }
    }
}
Validator.isSDT=function(selector){
    return {
        selector,
        test: function(value){
            const regex=/^0\d{9}$/;
            return regex.test(value) ? undefined : `Số điện thoại không hợp lệ`
        }
    }
}

