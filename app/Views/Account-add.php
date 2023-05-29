<?php include($_SERVER['DOCUMENT_ROOT'] . '/quiz-project/app/Views/Account-top.php') ?>
<h3 class=" text-center mb-5">Create test</h3>
<form class="w-50 mx-auto" id="form" action="add-test" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3 repeat-block">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" id="question" name="question1">
        <p class="answer-title mt-3">Answer choices</p>
        <div class="box-answer-wrapper">
            <div class="box-answer  gap-3 d-flex">
                <input type="text" class="form-control"  name="answer1[]">
                <input type="text" class="form-control"  name="answer1[]">
                <input type="text" class="form-control"  name="answer1[]">
                <input type="text" class="form-control"  name="answer1[]">
            </div>
            <p class="answer-title mt-3">Answer choices true</p>
            <div class="box-answer gap-3 d-flex">
                <input type="text" class="form-control"  name="answer-true1">
            </div>
        </div>
    </div>
    <button class="my-3 btn btn-secondary add-field--question w-100" type="button">Added question</button>
    <div class="error mb-3"></div>
    <div class="message mb-3"></div>
    <input type="text" class="num-questions" name="num">
    <button type="submit" class="btn btn-primary text-center px-5">Save</button>

</form>
<script src="assets/js/account-add.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/quiz-project/app/Views/Account-bottom.php') ?>
