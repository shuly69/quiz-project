<?php include($_SERVER['DOCUMENT_ROOT'] . '/quiz-project/app/Views/Account-top.php') ?>
    <style>

    </style>
    <div class="quiz__sort d-flex justify-content-end">
        <form action="select" class="sorting-form" method="post">
            <select class="form-select quiz__select" name="sorting" id="" >
                <option value="" disabled selected hidden>Sorting</option>
                <option value="dt_add">Creation date</option>
                <option value="id_test">id</option>
            </select>
        </form>
    </div>
    <div class="quiz__box">
        <?php foreach($quizzes as $quiz) : ?>
            <?php $quizBody = json_decode($quiz->getTest());
            $question = 'question';
            $answer = 'answer';
            $answerTrue = 'answer-true';
            ?>

                   <article class="item" id="<?= $quiz->getIdTest()?>">
                       <h3 class="item__title"><?= $quizBody->title?></h3>
                       <form action="control-test"  class="form-control" method="post">
                        <?php for($i = 1; $i <= $quizBody->num; $i++) :?>
                           <ul class="item__question-box">
                               <li class="item__answer-elem item__question-tile"><?=$quizBody->{$question . $i} ?? ''; ?></li>
                               <? for($j = 0; $j < count($quizBody->{$answer . $i}); $j++) : ?>
                               <li class="item__answer-elem"><input class="item__answer-radio" type="radio" name="answer<?=$i?>" <?= ($j === 0) ? 'checked' : ''?> value="<?=$quizBody->{$answer . $i}[$j]?>"><?=$quizBody->{$answer . $i}[$j]?></li>
                               <? endfor; ?>

                               <input type="text" class="item__answer-true" name="answer-true<?=$i?>" value="<?=$quizBody->{$answerTrue . $i} ?? ''?>">

                           </ul>
                        <?php endfor ?>
                           <input type="text" class="num-questions" name="num" value="<?=$quizBody->num?>">
                           <button class="btn btn-primary submit-button" type="submit">Result</button>
                           <span class="item__question-result"></span>
                           <button class="btn btn-primary edit-button" type="button" >Edit</button>
                       </form>
                   </article>
        <?php endforeach; ?>
    </div>
    <script src="assets/js/account-main.js"></script>
    <script src="assets/js/account-test-edit.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/quiz-project/app/Views/Account-bottom.php') ?>