<?php
require 'includes/conn.php';


?>

<?php
$attained_input = $_POST['attained_input'] ?? ''; // Default to empty string if not set
$options_selected = $_POST['options'] ?? ''; // Store the selected option for the second dropdown
$confirmation_input = $_POST['confirmation_input'] ?? ''; // Store the text input value

$form_action = '';
if (!empty($attained_input)) {
    if ($attained_input == 'Grade 11' || $attained_input == 'Grade 12') {
        // Fetch strands
        $select_strands = mysqli_query($conn, "SELECT * FROM tbl_strands");
        while ($row2 = mysqli_fetch_array($select_strands)) {
            $selected = ($options_selected == $row2['strand_id']) ? 'selected' : '';
            $form_action .= "<option class='{$row2['strand_id']}' value='{$row2['strand_id']}' $selected>{$row2['strand_desc']}</option>";
        }
    } elseif ($attained_input == 'College') {
        // Fetch programs
        $select_programs = mysqli_query($conn, "SELECT * FROM tbl_programs");
        while ($row3 = mysqli_fetch_array($select_programs)) {
            $selected = ($options_selected == $row3['program_id']) ? 'selected' : '';
            $form_action .= "<option value='{$row3['program_id']}' $selected>{$row3['program_desc']}</option>";
        }
    }
}
?>

<form method="post" action=""> 
    <label for="attained_input">Select Attained Input:</label>
    <select name="attained_input" id="attained_input" onchange="this.form.submit()">
        <option value="">--Select--</option>
        <option value="Grade 11" <?php echo ($attained_input == 'Grade 11') ? 'selected' : ''; ?>>Grade 11</option>
        <option value="Grade 12" <?php echo ($attained_input == 'Grade 12') ? 'selected' : ''; ?>>Grade 12</option>
        <option value="College" <?php echo ($attained_input == 'College') ? 'selected' : ''; ?>>College</option>
    </select>

    <label for="options">Select Option:</label>
    <select name="options" id="options">
        <?php echo $form_action; ?>
    </select>

    <label for="confirmation_input">Confirmation Input:</label>
    <input type="text" name="confirmation_input" id="confirmation_input" value="<?php echo htmlspecialchars($confirmation_input); ?>">
    
    <input type="submit" value="Submit">
</form>
