<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="container">
	<h1 class="my-3">
		<? $APPLICATION->ShowTitle(false); ?>
	</h1>
	<div class="my-2">
		Доступные цвета:
		<?= $arResult['COLOR_NAMES'] ?>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			<div class="card my-3">
				<div class="card-body">
					<form>
						<p class="card-text">
							<label for="commercial" class="mx-3">Коммерческий транспорт</label>
							<input type="checkbox" name="commercial" id="commercial" <?= $arParams['COMMERCIAL'] ? 'checked' : '' ?>>
						</p>
						<p class="card-text">
							<label for="age" class="mx-3">Авто не старше 2 лет</label>
							<input type="checkbox" name="age" id="age" <?= $arParams['AGE'] ? 'checked' : '' ?>>
						</p>
						<p class="card-text">
							<label for="color" class="mx-3">Цвет</label>
							<select name="color" id="color">
								<option value="0">Не выбран</option>
								<? foreach ($arResult['COLOR_FILTER'] as $item): ?>
									<option value="<?= $item['ID'] ?>" <?= $arParams['COLOR'] == $item['ID'] ? 'selected' : '' ?>>
										<?= $item['NAME'] ?></option>
								<? endforeach; ?>
							</select>
						</p>
						<p class="card-text">
							<button type="submit" class="btn btn-primary mx-3">Выбрать</button>
						</p>
					</form>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<div class="card my-3">
					<div class="card-body">
						<h5 class="card-title">
							<?= $arItem["MARK"] ?>
						</h5>
						<p class="card-text">
							<mark>
								<?= $arItem["MODEL"] ?>
							</mark>
						</p>
						<p class="card-text">
							Дата производства:
							<?= $arItem["PRODUCTION_DATE"]->format('Y-m') ?>
						</p>
						<p class="card-text">
							Грузоподъемность:
							<?= $arItem["CAPACITY"] ?> кг
						</p>
						<p class="card-text">
							Цвет:
							<?= $arItem["COLOR_NAME"] ?>
						</p>
						<? if ($arItem["COMMERCIAL"] == "Y"): ?>
							<p class="card-text"><em>Коммерческий транспорт</em></p>
						<? endif; ?>
					</div>
				</div>
			<? endforeach; ?>
		</div>

	</div>