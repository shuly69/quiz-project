
const form = document.querySelector('#form')
const repeat = document.querySelector('.repeat-block')
const buttonQuestion = document.querySelector('.add-field--question')
const buttonSubmit = document.querySelector('button[type="submit"]')
let n = 1;
const requestURL = form.action
const errors = document.querySelector('.error')
const message = document.querySelector('.message')
let num = document.querySelector('.num-questions')
form.addEventListener('click', function(event) {
        num.value = n
        let elemButton = event.target

        if(elemButton === buttonQuestion){
            n = n + 1;
            if(n > 10) {
                elemButton.setAttribute('disabled', '')
            }

            repeat.insertAdjacentHTML('afterend', `<div class="mb-3 repeat-block">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" id="question" name="question${n}">
        <p class="answer-title mt-3">Answer choices</p>
        <div class="box-answer-wrapper">
            <div class="box-answer  gap-3 d-flex">
                <input type="text" class="form-control"  name="answer${n}[]">
                <input type="text" class="form-control"  name="answer${n}[]">
                <input type="text" class="form-control"  name="answer${n}[]">
                <input type="text" class="form-control"  name="answer${n}[]">
            </div>
            <p class="answer-title mt-3">Answer choices true</p>
            <div class="box-answer gap-3 d-flex">
                <input type="text" class="form-control"  name="answer-true${n}">
            </div>
        </div>
    </div>`)
        }

        if(elemButton === buttonSubmit) {
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
                    buttonSubmit.setAttribute('disabled', '')
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
        }

    })






