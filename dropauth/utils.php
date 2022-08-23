<?php
function variable_exists($variable_to_check) {
    if ($variable_to_check !== null and $variable_to_check !== "") {
        return true;
    } else {
        return false;
    }  
}

function load_database($database_to_load) {
    if (file_exists($database_to_load)) { // Check if the selected database already exists
        return unserialize(file_get_contents($database_to_load)); // Load the selected database file from the disk.
    } else {
        if (is_writable(".")) { // Check if the current directory is writable by PHP before trying to create the database file.
            file_put_contents($database_to_load, serialize(array())); // Create a database file with an empty array and write it to the disk.
            return array(); // Load an empty array.
        } else {
            echo "<p class='error'>The DropAuth folder is not writable by PHP. This is a technical error. Please contact a site admin to make them aware of this issue.</p>"; // Throw an error if the DropAuth directory isn't writable by PHP.
            exit();
        }
    }
}
?>
