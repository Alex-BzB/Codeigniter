<h1>Все Юзеры</h1>
<?foreach($users as $row){?>
  <a href="users/<?=$row['name']?>"> <?=$row['name']?></a>
  </br>
<?}?>
