<?php
function calculate_string($mathString) {
    $mathString = trim($mathString); // trim white spaces
    $mathString = ereg_replace ('[^0-9\+-\*\/\(\) ]', '', $mathString); // remove any non-numbers chars; exception for math operators
    $compute = create_function("", "return (" . $mathString . ");" );
    return 0 + $compute();
}
