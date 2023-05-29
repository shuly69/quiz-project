let buttonEdit = document.querySelectorAll('.edit-button')

buttonEdit.forEach(function(element) {
    element.addEventListener('click', function(event) {
        let formNode = event.target.parentNode
        let articleNode = formNode.parentNode
        let id = articleNode.id
        const xhr = new XMLHttpRequest()
        const formData = new FormData(sortingForm)
        formData.append('id', id)
        xhr.open('POST', 'edit');
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.status !== 200) {
                return;
            }
            const response = xhr.response;
            if(response.status) {

                let test = JSON.parse(response.test.body_test)

                let htmlFormEdit = `<form class="w-50 form-edit" id="form" action="update-test" method="post">
                    <div class="mb-3">
                 <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="${test.title}">
                </div>`
                for(let i = 1; i <= parseInt(test.num); i++) {
                    let questionElem = 'question' + i
                    let answerElem = 'answer' + i
                    let answerTrueElem = 'answer-true' + i
                    htmlFormEdit += `<div class="mb-3 repeat-block">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question${i}" value="${test[questionElem]}">
                        <p class="answer-title mt-3">Answer choices</p>
                        <div class="box-answer-wrapper">
                        <div class="box-answer  gap-3 d-flex">`
                    for(let j = 0; j < test[answerElem].length; j++) {
                        htmlFormEdit += `<input type="text" class="form-control"  name="answer${i}[]" value="${test[answerElem][j]}">`
                    }
                        htmlFormEdit += `</div>
                            <p class="answer-title mt-3">Answer choices true</p>
                            <div class="box-answer gap-3 d-flex">
                                <input type="text" class="form-control"  name="answer-true${i}" value="${test[answerTrueElem]}">
                            </div>
                        </div>
                           </div>`
                }
                htmlFormEdit += `<div class="error mb-3"></div>
    <div class="message mb-3"></div>
    <input type="text" class="num-questions" name="num" value="${test['num']}">
    <input type="text" hidden name="id" value="${response.test.id_test}">
    <button type="submit" class="btn btn-primary text-center px-5">Save</button>

</form>`
                articleNode.innerHTML = htmlFormEdit
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

                    let elemButton = event.target
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

            }
        }
        xhr.send(formData);
    })
})