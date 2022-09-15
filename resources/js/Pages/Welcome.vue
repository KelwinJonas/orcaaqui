<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdicionarButton from '../Components/AdicionarButton.vue';
</script>

<template>
    <AppLayout title="Início">
        <div>
            <img src="/img/construcao.jpg" alt="">
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="grid grid-cols-1 gap-4 lg:grid-cols-3 sm:grid-cols-2 ">
                        <div v-for="produto in produtos.data"
                        :key="produto.id"
                        class="w-full px-4 lg:px-0">
                            <div class="p-3 bg-white rounded shadow-md">
                            <div class="">
                                <div class="relative w-full mb-3 h-62 lg:mb-0">
                                <img src="https://cdn.pixabay.com/photo/2014/09/13/21/46/milling-444493_960_720.jpg" alt="Produto"
                                    class="object-fill w-full h-full rounded">
                                </div>
                                <div class="flex-auto p-2 justify-evenly">
                                <div class="flex flex-wrap ">
                                    <div class="flex items-center justify-between w-full min-w-0 ">
                                    <h2 class="mr-auto text-2xl font-extrabold ">
                                        {{produto.nome}}
                                    </h2>
                                    </div>
                                </div>
                                <div class="text-blue mt-1 text-xl font-bold">R${{ produto.valor }}</div>
                                <div class="text-muted">
                                    no boleto ou depósito. Compre em até 6x de R${{ (produto.valor/6).toFixed(2) }} sem juros
                                </div>
                                <div class="row text-center">
                                    <AdicionarButton class="w-full h-10" v-if="$page.props.user && $page.props.user.role == 1" @click="add_cart(produto)">
                                        COMPRAR
                                    </AdicionarButton>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 pb-4 bg-white">
                    <pagination :data="produtos" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
    import Pagination from "../Shared/Pagination.vue";
    export default {
    components: { Pagination, AppLayout},
    name: "Produtos",
    props: {
      produtos: Object,
    },
    methods: {
        add_cart: function (produto) {
            this.$inertia.post('/pedidos', produto)
            this.open_cart();
        },
        open_cart: function () {
            var carrinho = document.getElementById("cart");
            if (carrinho.getAttribute("open") == "false") {
                carrinho.setAttribute("open", "true");
            }
        },
    }
    }
</script>
