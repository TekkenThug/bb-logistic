<template>
    <div class="client__item">
        <h4 class="client__item-title">
            Заявка № <span class="status">

        </span>

<!--            <span style="font-size: 16px" class="mt-2 d-block">Курьер: {{ $courier }}, {{ $courierPhone }}</span>-->

            <div class="buttons">
                <form class="order-change">

                    <input type="hidden" name="order-id" value="">

                    <a class="btn edit-order" href="" title="Изменить"><i class="fas fa-pen"></i></a>
                    <button class="btn delete-order" data-method="DELETE" data-url=""
                            title="Отменить"><i class="fas fa-times"></i></button>

                    <button type="button" class="btn btn-more" title="Раскрыть"><i class="fas fa-chevron-down"></i></button>
                </form>
            </div>
            <div class="short-descr">
                <span></span>
                <span class="address"></span>
                <span class="type"></span>
            </div>
        </h4>

        <div class="client__item-info">
            <div class="info">
                <span></span>
            </div>
            <div class="info">
                <span></span>
            </div>
            <div class="info">
                <span></span>
            </div>
            <div class="info">
                <span></span>
            </div>
            <div class="info">
                <span></span>
            </div>
            <div class="info">
<!--                @foreach($contacts as $contact)-->
<!--                <span>{{ $contact }}</span>-->
<!--                @endforeach-->
            </div>
            <div class="info">
<!--                @foreach($products as $product)-->
<!--                <span>{{ $product->name }} - {{ $product->count }} шт.</span>-->
<!--                @endforeach-->
            </div>
            <div class="info">
<!--                <span>{{ isset($pay) ? 'Да - '.$pay.' руб.' : 'Нет' }}</span>-->
            </div>
            <div class="info">
<!--                <span>{{ $comment }}</span>-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderRow"
}
</script>

<style scoped>

</style>
