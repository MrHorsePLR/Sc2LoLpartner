<?php foreach ($leagues as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>

<?php

$this->Js->get('league_id')->event(

'change',
$this->Js->request(
array('controller' => 'leagues', 'action' => 'lists'),
array(
'update' => 'league_id',
'async' => true,
'dataExpression' => true,
'method' => 'post',
'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
)
)
);
?>
