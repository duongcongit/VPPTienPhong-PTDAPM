<?php if(isset($_SESSION['error'])) { ?>
    <p class="error" style="color: red;"><?php echo $_SESSION['error'];?></p>
    <?php     
        unset($_SESSION['error']);
    }  
?>

<?php if(isset($_SESSION['success'])) { ?>
    <p class="success" style="color: green;"><?php echo $_SESSION['success']; ?></p>
    <?php     
    unset($_SESSION['success']);
    }  
?>