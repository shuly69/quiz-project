(() => {
    'use strict'


    const form = document.querySelector('#form')
    const requestURL = form.action
    const errors = document.querySelector('.error')
    const message = document.querySelector('.message')
    const button = document.querySelector('button[type="submit"]')

        form.addEventListener('submit', event => {
            message.classList.remove('message-color')
            errors.innerHTML = ''
            message.innerHTML = ''
            const xhr = new XMLHttpRequest();
            const formData = new FormData(form)

            xhr.open('POST', requestURL);
            xhr.responseType = 'json';
            xhr.onload = () => {
                if (xhr.status !== 200) {
                    return;
                }
                const response = xhr.response;

                if(response.status) {
                    message.classList.add('message-color')
                    message.innerHTML = `<div>${response['message']}</div>`
                    button.setAttribute('disabled', '')
                    const locationPath = response['path']
                        setTimeout(function(){
                        window.location.href = locationPath
                    }, 2000)
                }else{
                    for(let value in response.errors) {
                        errors.innerHTML += `<li class="error-item">${response.errors[value]}</li>`

                    }
                }
            }
            xhr.send(formData);

            event.preventDefault()
            event.stopPropagation()
        }, false)

})()