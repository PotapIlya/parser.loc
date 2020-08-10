<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/files/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
	<main>
		<div class="container">

			<div class="wrapper">

				<?
					require_once 'pdo/pdo.php';

					$query = $mysql->prepare("SELECT * FROM parser");
					$query->execute();
					$res = $query->fetchAll();


					foreach ($res as $item)
					{
				?>

					<div class="d-flex flex-column px-4">

						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h3><?=$item['title']?></h3>
								<span><?=$item['category']?></span>
							</div>
							<div>
								<p>Цена: <span><?=$item['price']?></span></p>
								<a href="<?=$item['href']?>" class="btn btn-success">Перейти</a>
							</div>
						</div>
						<div>
							<h3 class="text-center">Описание</h3>
							<style>
								br{
									display: none;
								}
							</style>
							<p>
								<?=$item['text']?>
							</p>
						</div>

					</div>


				<? } ?>

			</div>


		</div>
	</main>
</body>
</html>