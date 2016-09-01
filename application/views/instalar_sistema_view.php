<?php 

function base($val = NULL)
{
	$url = "http://" . $_SERVER['HTTP_HOST'];
	$url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	if($val != NULL)
		return $url.$val;
	else
		return $url;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(isset($titulo)): ?>{titulo}<?php endif; ?> - {titulo_padrao}</title>
	<link rel="stylesheet" href="<?php echo base('dist/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base('dist/css/estiloAdm.min.css'); ?>">
	<base href="<?php echo base(); ?>">
</head>
<body>
	<div class="container">
		{conteudo}
	</div>
	<footer id="footer">
		<div class="container textoCentralizado">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					{rodape}
				</div>
			</div>
		</div>
	</footer>
	<!-- SCRIP PADRÃO -->
	<script src="<?php echo base('dist/js/jquery-2.1.4.min.js'); ?>"></script>
	<script src="<?php echo base('dist/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base('dist/js/scriptAdm.min.js'); ?>"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/r/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-colvis-1.0.3,b-flash-1.0.3,b-html5-1.0.3,b-print-1.0.3,r-1.0.7/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.9/sorting/numeric-comma.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="<?php //echo base_url('dist/js/scriptAdm.min.js');?>" type="text/javascript" charset="utf-8" async defer></script> -->
</body>
</html>