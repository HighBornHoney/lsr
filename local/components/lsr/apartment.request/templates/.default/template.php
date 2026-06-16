<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 */

?>
<form id="request-form" class="request-form">
    <h2>Заявка на объект недвижимости</h2>

    <div class="form-group">
        <label for="name">Имя</label>
        <input
                type="text"
                id="name"
                name="name"
                required
        >
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input
                type="email"
                id="email"
                name="email"
                required
        >
    </div>

    <div class="form-group">
        <label for="phone">Телефон</label>
        <input
                type="tel"
                id="phone"
                name="phone"
                placeholder="+7 (999) 999-99-99"
                required
        >
    </div>

    <div class="form-group">
        <label for="house-select">Дом</label>

        <select
                id="house-select"
                required
        >
            <option value="">Выберите дом</option>
        </select>
    </div>

    <div class="form-group">
        <label for="apartment-select">Квартира</label>

        <select
                id="apartment-select"
                name="apartment-select"
                required
                disabled
        >
            <option value="">Сначала выберите дом</option>
        </select>
    </div>

    <div id="form-message" class="form-message"></div>

    <button type="submit" class="btn">
        Отправить
    </button>
</form>
