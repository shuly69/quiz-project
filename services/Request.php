<?php
namespace Services;
use Services\ActiveRecordEntity;
class Request {
    public array $post;
    public ActiveRecordEntity $model;
    public function __construct(ActiveRecordEntity $model) {
        $this->model = $model;
        if(!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if(is_string($value)) {
                    $this->post[$key] = htmlspecialchars(trim($value));
                }
                if(is_array($value)) {
                    $this->post[$key] = $value;
                }
            }
        }
    }

    public function resultTest() : string {
        $scores = 0;
        for($i = 1; $i <= $this->post['num']; $i++ ) {


                if($this->post['answer-true' . $i] === $this->post['answer' . $i]) {
                    $scores += 1 ;
                }

        }

        return $scores . ' of ' . $this->post['num'];
    }

    public function validation(array $validate = []) : array {
        foreach($validate as $key => $value) {
            if(preg_match('~ane~', $value, $matches)) {
                for($i = 1; $i <= $this->post['num']; $i++) {
                    if(isset($this->post[$key . $i]) && is_array($this->post[$key . $i])) {
                        if(array_key_exists($key . $i, $this->post)) {
                            $title = 'answer';
                            for($j = 0; $j < count($this->post[$key . $i]); $j++) {
                                (mb_strlen($this->post[$key . $i][$j]) > 0) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, a mandatory field to be filled in";
                            }
                        }
                    }
                }
            }


            $keyNum = $this->post['num'] ?? 1;
            for($i = 1; $i <= $keyNum; $i++) {
                if(array_key_exists($key, $this->post) || array_key_exists($key . $i, $this->post)) {
                    if (preg_match('~min:(\d*)~', $value, $matches)) {
                        $title = '';
                        if($key === 'question' || $key === 'answer-true') {
                            $title = $key;
                            $this->min($key . $i, (int)$matches[1]) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, the minimum number of characters.At least $matches[1] characters";
                        }else {
                            $this->min($key, (int)$matches[1]) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, the minimum number of characters.At least $matches[1] characters";
                        }
                    }

                    if (preg_match('~max:(\d*)~', $value, $matches)) {
                        $title = $key;
                        if($key === 'question' || $key === 'answer-true') {
                            $this->max($key . $i, (int)$matches[1]) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, the maximum number of characters. no more than $matches[1] characters";
                        }else {
                            $this->required($key) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, the maximum number of characters. no more than $matches[1] characters";
                        }
                    }

                    if (preg_match('~required~', $value, $matches)) {
                        $title = $key;
                        if($key === 'question' || $key === 'answer-true') {
                            $this->required($key . $i) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, a mandatory field to be filled in";
                        }else {
                            $this->required($key) ? '' : $this->post['errors'][$key] = "The $title field must satisfy the condition, a mandatory field to be filled in";
                        }

                    }

                    if (preg_match('~password-confirm~', $value, $matches)) {
                        $this->passwordConfirm($key) ? '' : $this->post['errors'][$key] = "Passwords do not match";
                    }

                    if (preg_match('~password-hash~', $value, $matches)) {
                        $this->passwordHash($key);
                    }

                    if (preg_match('~unique~', $value, $matches)) {
                        $this->unique($key) ? $this->post['errors'][$key] = "$key already registered" : '';
                    }

                    if (preg_match('~email-verify~', $value, $matches)) {
                        if(mb_strlen($this->post[$key]) > 5) {
                            $this->unique($key) ? '' : $this->post['errors'][$key] = "This $key is not registered";
                        }
                    }

                    if (preg_match('~password-verify~', $value, $matches)) {
                        if(mb_strlen($this->post[$key]) > 5) {
                            $this->passwordVerify() ? '' : $this->post['errors'][$key] = "Incorrect password entered";
                        }
                    }

                    if (preg_match('~match-answer~', $value, $matches)) {
                        $this->matchAnswer($key) ? '' : $this->post['errors'][$key] = "The number of correct answers exceeds the number of choices";
                    }

                    if (preg_match('~control-true-answer~', $value, $matches)) {
                        $this->controlTrueAnswer($key, $i) ? '' : $this->post['errors'][$key] = "There must be at least one correct answer";
                    }
                }
            }
            }


        return $this->post;
    }

    private function controlTrueAnswer($name, $num) : bool {
        if(in_array($this->post[$name . $num], $this->post['answer' . $num])) {
            return true;
        }
        return false;
    }

    private function matchAnswer(string $name) :bool {
        if(count($this->post['answer-true1']) > count($this->post[$name])) {
            return false;
        }
        return true;
    }

    private function passwordVerify() : bool {
        return $this->model->passwordControl($this->post['email'], $this->post['password']);;
    }

    private function unique(string $name) : bool {

        $arrayUnique = $this->model->getUniqueElem('email');

        foreach ($arrayUnique as $value) {
            if(in_array($this->post[$name], $value, true)) {
                return true;
            }
        }
        return false;
    }

    private function min(string $name, int $minNumber) : bool {
        if(mb_strlen($this->post[$name]) >= $minNumber) {
             return true;
         }
            return false;
    }

    private function max(string $name, int $maxNumber) : bool {
        if(mb_strlen($this->post[$name]) <= $maxNumber) {
            return true;
        }
        return false;
    }

    private function required(string $name) : bool {
        if(mb_strlen($this->post[$name]) > 0) {
            return true;
        }
        return false;
    }

    private function passwordHash(string $name) : void {
        $passwordClean = $this->post[$name];
        $passHash = password_hash($passwordClean, PASSWORD_BCRYPT);
        $this->post[$name] = $passHash;
    }

    private function passwordConfirm(string $name) : bool {
        if($this->post[$name] === $_POST['password']) {
            return true;
        }
        return false;
    }

}