<?php

// Include the functions file
require_once('functions.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get user input
  $num1 = $_POST["num1"];
  $num2 = $_POST["num2"];
  $operator = $_POST["operator"];

  // Validate input 
  if (!is_numeric($num1) || !is_numeric($num2)) {
    $error = "Please enter valid numbers.";
  } else {
    // Convert numbers to floats for calculations
    $num1 = floatval($num1);
    $num2 = floatval($num2);

    // Call appropriate function based on operator
    switch ($operator) {
      case "+":
        $result = add($num1, $num2);
        break;
      case "-":
        $result = subtract($num1, $num2);
        break;
      case "*":
        $result = multiply($num1, $num2);
        break;
      case "/":
        if ($num2 == 0) {
          $error = "Error: Cannot divide by zero.";
        } else {
          $result = divide($num1, $num2);
        }
        break;
        case"Log":
       if ($num1 > 0) {
            $result = log($num1, $base);
         } else {
            $result = 'Error: Logarithm of non-positive number';
        }
        break;
        case 'percentage':
                $result = percentage($num1, $num2);
                break;
         case 'sqrt':
              $result = Sqrt($num1);
                break;
        case"%":
          $result=modulus($num1,$num2);
          break;
      case "^":
        $result = exponentiate($num1, $num2);
        break;
      default:
        $error = "Invalid operation selected.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator</title>
</head>
<body>
  <h1>Calculator</h1>

  <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="num1">Enter first number:</label>
    <input type="text" name="num1" id="num1" value="<?php echo isset($num1) ? $num1 : ''; ?>">

    <label for="operator">Choose Operator:</label>
    <select name="operator" id="operator">
      <option value="+">+</option>
      <option value="-">-</option>
      <option value="*">*</option>
      <option value="/">/</option>
      <option value="^">^</option>
      <option value="%">%</option>
      <option value="Log">Log</option>
      <option value="Percentage">percentage</option>
      <option value="Sqrt">Sqrt</option>
    </select>

    <label for="num2">Next number:</label>
    <input type="text" name="num2" id="num2" value="<?php echo isset($num2) ? $num2 : ''; ?>">

    <br><br>
    <input type="submit" value="Calculate">
  </form>

  <?php if (isset($result)): ?>
    <p>Result: <?php echo $result; ?></p>
  <?php endif; ?>

</body>
</html>
