<style type="text/css">
    .divTable
    {
        display:  table;
        width:auto;
        background-color:#eee;
        border:1px solid  #666666;
        border-spacing:5px;/*cellspacing:poor IE support for  this*/
        /* border-collapse:separate;*/
    }

    .divRow
    {
        display:table-row;
        width:auto;
    }

    .divCell
    {
        float:left;/*fix for  buggy browsers*/
        display:table-column;
        width:200px;
        background-color:#ccc;
    }
</style>
<body>
    <div class="divTable">
        <div class="headRow">
            <div class="divCell" align="center">User ID</div>
            <div  class="divCell">User Name</div>
            <div  class="divCell">User Firstname</div>
            <div  class="divCell">User Lastname</div>
            <div  class="divCell">Country</div>
            <div  class="divCell">Rating</div>
            <div  class="divCell">Data registration</div>
        </div>
        <?php
            foreach ($records as $record){
        ?>
        <div class="divRow">
            <div class="divCell" align="center"><?php echo $record['id']; ?></div>
            <div class="divCell"><?php echo $record['username'];?></div>
            <div class="divCell"><?php echo $record['firstname'];?></div>
            <div class="divCell"><?php echo $record['lastname'];?></div>
            <div class="divCell"><?php echo $record['country'];?></div>
            <div class="divCell"><?php echo $record['rate'];?></div>
            <div class="divCell"><?php echo $record['dataregistration'];?></div>
        </div>
        <?php } ?>
    </div>
</body>