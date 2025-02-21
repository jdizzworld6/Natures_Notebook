
<?php

// test input boxes if error displays error under input box

// class to get new input box error handler for inputbox
Class inputBoxErrorHandler {
    private $isset;
    private $input;
    private $varLength;
    private $errorMessage;
    private $maxLength;
    private $styles = "style='color: red'";

    public function __construct($isset, $input, $varLength, $errorMessage, $maxLength=500){
        $this->isset = $isset;
        $this->input = $input;
        $this->varLength = $varLength;
        $this->errorMessage = $errorMessage;
        $this->maxLength = $maxLength;
    }
// generic test for input box
    public function testInputBox(){
        
        $inputLenght = strlen($this->input);
        if ($this->isset){
            if ($this->input == '') {
                return "<h4 " . $this->styles . " > Required </h4>";
            }
            if ($inputLenght < $this->varLength){
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } elseif ($inputLenght > $this->maxLength) {
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } else{
                return "";
            }
        }
    }
// ensures a category is selected
    public function testCategorySelect() {
        $catSelected = $this->input;

        if ($catSelected == 1){
            return "<h4 " . $this->styles . " > Required </h4>";
        }
    }
}

// runs test and returns whether all passed
if (isset($_POST['save'])){


    $passAllInputBoxTest= false;

    $photoNameTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['name'], 4, "Photo Name is required");

    $photoNameTestReturn = $photoNameTest->testInputBox();

    $categorySelect = new inputBoxErrorHandler(isset($_POST['save']), $_POST["photo_category"],20, "Need to select category.");

    $categorySelectReturn = $categorySelect->testCategorySelect();

    if ($photoNameTestReturn == "" && $categorySelectReturn == "") {
        $passAllInputBoxTest = true;
    }
    $test = '';

 }