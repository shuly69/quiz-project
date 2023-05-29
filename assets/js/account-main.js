let form = document.querySelectorAll('.form-control')
form.forEach(function(element) {

    element.addEventListener('click', function(event) {

        const requestURL = element.action
        const submit = event.target
        if(submit.classList.contains('submit-button')) {
            const result = submit.nextElementSibling
            const xhr = new XMLHttpRequest()
            const formData = new FormData(element)
            const formReset = submit.form
            xhr.open('POST', requestURL);
            xhr.responseType = 'json';
            xhr.onload = () => {
                if (xhr.status !== 200) {
                    return;
                }
                const response = xhr.response;
                if(response.status) {
                    result.innerHTML = `${response['message']}`
                    submit.setAttribute('disabled', '')

                    setTimeout(function(){
                        element.reset()
                        submit.removeAttribute('disabled')
                        result.innerHTML = ''
                    }, 5000)
                }
            }
            xhr.send(formData);
            event.preventDefault()
            event.stopPropagation()
        }


    })
})

const sortingForm = document.querySelector('.sorting-form')
const container = document.querySelector('.quiz__box')
sortingForm.addEventListener('change', function(event) {
    container.innerHTML = ''
    let select = event.target
    let value = select.value
    const formData = new FormData(sortingForm)
    formData.append('select', value)
    const requestURL = sortingForm.action
    const xhr = new XMLHttpRequest()
    xhr.open('POST', requestURL)
    xhr.responseType = 'json'
    xhr.onload = () => {
        if(xhr.status !== 200) {
            return
        }
        const response = xhr.response
        if(response.status) {

            response.value.forEach(function(item) {
                let test = JSON.parse(item.body_test)

                let testBody = `<article class="item" id="${item.id_test}">`
                testBody += `<h3 class="item__title">${test.title}</h3><form action="control-test"  class="form-control" method="post">`

                for(let i = 1; i <= parseInt(test.num); i++) {
                    let questionElem = 'question' + i
                    let answerElem = 'answer' + i
                    let answerTrueElem = 'answer-true' + i
                    testBody += `<ul class="item__question-box"><li class="item__answer-elem item__question-tile">${test[questionElem]}</li>`
                    for(let j = 0; j < test[answerElem].length; j++) {
                        testBody += `<li class="item__answer-elem"><input class="item__answer-radio" type="radio" name="${answerElem}"  ${j === 0 ? 'checked' : ''} value="${test[answerElem][j]}">${test[answerElem][j]}</li>`
                    }
                    testBody += `<input type="text" class="item__answer-true" name="answer-true${i}" value="${test[answerTrueElem]}"></ul>`
                }
                    testBody += `<input type="text" class="num-questions" name="num" value="${test.num}"><button class="btn btn-primary submit-button" type="submit">Result</button><span class="item__question-result"></span><button class="btn btn-primary edit-button" type="button" style="margin-left:5px">Edit</button></form></article>`
                container.innerHTML += testBody
                //container.append(testBody)

            })

        }
        let formNew = document.querySelectorAll('.form-control')

        formNew.forEach(function(element) {

            element.addEventListener('click', function(event) {

                const requestURL = element.action
                const submit = event.target
                if(submit.classList.contains('submit-button')) {
                    const result = submit.nextElementSibling
                    const xhr = new XMLHttpRequest()
                    const formData = new FormData(element)
                    const formReset = submit.formNew
                    xhr.open('POST', requestURL);
                    xhr.responseType = 'json';
                    xhr.onload = () => {
                        if (xhr.status !== 200) {
                            return;
                        }
                        const response = xhr.response;
                        if(response.status) {
                            result.innerHTML = `${response['message']}`
                            submit.setAttribute('disabled', '')

                            setTimeout(function(){
                                element.reset()
                                submit.removeAttribute('disabled')
                                result.innerHTML = ''
                            }, 5000)
                        }
                    }
                    xhr.send(formData);
                    event.preventDefault()
                    event.stopPropagation()
                }


            })
        })

    }

    xhr.send(formData);

})