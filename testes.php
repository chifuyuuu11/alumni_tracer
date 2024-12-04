<?php
require 'includes/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade and Strand/Program Selection</title>
    <script>
        function showOptions() {
            var gradeSelect = document.getElementById("grade");
            var combinedSelect = document.getElementById("select_combined");
            combinedSelect.innerHTML = ''; // Clear previous options

            if (gradeSelect.value === "2") {
                // Load strands for grade 2
                var strands = <?php
                    $select_strand = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = 4;");
                    $strands = [];
                    while ($row = mysqli_fetch_array($select_strand)) {
                        $strands[] = [
                            'value' => $row['dept_id'],
                            'desc' => $row['program_desc']
                        ];
                    }
                    echo json_encode($strands);
                ?>;
                
                strands.forEach(function(strand) {
                    var option = document.createElement("option");
                    option.value = strand.value;
                    option.text = strand.desc;
                    combinedSelect.add(option);
                });
            } else if (gradeSelect.value === "3") {
                // Load programs for grade 3
                var programs = <?php
                    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = 5;");
                    $programs = [];
                    while ($row = mysqli_fetch_array($select_program)) {
                        $programs[] = [
                            'value' => $row['program_id'],
                            'desc' => $row['program_desc']
                        ];
                    }
                    echo json_encode($programs);
                ?>;

                programs.forEach(function(program) {
                    var option = document.createElement("option");
                    option.value = program.value;
                    option.text = program.desc;
                    combinedSelect.add(option);
                });
            }
        }
    </script>
</head>
<body>
    <form action="process.php" method="post">
        <label for="grade">Select Grade Level:</label>
        <select id="grade" name="grade" onchange="showOptions()">
            <option disabled selected>Highest Level Attained at SFAC</option>
            <?php
                $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained");
                while ($row1 = mysqli_fetch_array($select_attained)) {
                    ?>
                    <option value="<?php echo $row1['sort_id']; ?>"><?php echo $row1['attained']; ?></option>
                    <?php
                }
            ?>
        </select>

        <div id="combinedSelectContainer">
            <label for="select_combined">Select Strand/Program:</label>
            <select required class="form-control select2" id="select_combined" name="combined">
                <option value="" disabled selected>Select Strand/Program</option>
                <!-- Options will be populated here based on grade selection -->
            </select>
        </div>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
