<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import IncrementButton from '../Components/IncrementButton.vue';
import TextInput from '../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/TextInput.vue';
import AdicionarButton from '../Components/AdicionarButton.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('welcome')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink v-if="$page.props.user" :href="route('welcome')" :active="route().current('welcome')">
                                    Início
                                </NavLink>
                                <NavLink v-if="$page.props.user && $page.props.user.role == 2" :href="route('produtos.index')" :active="route().current('produtos.index')">
                                    Produtos
                                </NavLink>
                                <NavLink v-if="$page.props.user && $page.props.user.role == 1" :href="route('pedidos.index')" :active="route().current('pedidos.index')">
                                    Pedidos
                                </NavLink>
                                <NavLink v-if="! $page.props.user" :href="route('login')" :active="route().current('login')">
                                    Entrar
                                </NavLink>
                                <NavLink v-if="! $page.props.user" :href="route('register')" :active="route().current('register')">
                                    Cadastrar-se
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                {{ $page.props.user.current_team.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <DropdownLink :href="route('teams.show', $page.props.user.current_team)">
                                                    Team Settings
                                                </DropdownLink>

                                                <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                                    Create New Team
                                                </DropdownLink>

                                                <div class="border-t border-gray-100" />

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <DropdownLink as="button">
                                                            <div class="flex items-center">
                                                                <svg
                                                                    v-if="team.id == $page.props.user.current_team_id"
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <div v-if="$page.props.user && $page.props.user.role == 1" @click="open_cart()" class="ml-3 relative right inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition cursor-pointer">
                                Carrinho
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button v-if="$page.props.user" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Configurar conta
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            Perfil
                                        </DropdownLink>

                                        <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                            API Tokens
                                        </DropdownLink>

                                        <div class="border-t border-gray-100" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Sair
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                            </div>

                            <div v-if="$page.props.user">
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </ResponsiveNavLink>

                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </ResponsiveNavLink>

                                <div class="border-t border-gray-200" />

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <ResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                    v-if="team.id == $page.props.user.current_team_id"
                                                    class="mr-2 h-5 w-5 text-green-400"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </ResponsiveNavLink>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
        <div id="cart" class="cart" open="false">
            <div class="text-right">
                <IncrementButton class="text-xl bg-red-500 pl-1" @click="open_cart()">
                    X
                </IncrementButton>
            </div>
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.flash.message">
                <div class="flex">
                    <p class="text-sm">{{ $page.props.flash.message }}</p>
                </div>
            </div>
            <div
                class="scroll justify-items-center grid grid-cols-1 lg:grid-cols-1 sm:grid-cols-2 ">
                <div v-for="produto in $page.props.carrinho.produtos"
                :key="produto.id"
                class="w-full px-4 lg:px-0 mt-2">
                    <div class="p-3 bg-white border rounded shadow-md">
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <img src="https://cdn.pixabay.com/photo/2014/09/13/21/46/milling-444493_960_720.jpg" alt="Just a flower"
                                        class="object-fill w-full h-full rounded">
                                </div>

                                <div class="grid grid-cols-2 gap-1">
                                    <div>
                                        <h2 class="text-base font-extrabold ">
                                            {{produto.nome}}
                                        </h2>
                                        <IncrementButton @click="increment_decrement($page.props.carrinho.pedido, produto, -1)">
                                            -
                                        </IncrementButton>
                                        <TextInput
                                            id="quantidade-{{produto}}"
                                            v-model="produto.quantidade"
                                            type="number"
                                            disabled
                                            step="1"
                                            min="1"
                                            max="{{produto.maximo}}"
                                            class="shadow appearance-none text-center rounded w-2/5 px-0 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            autocomplete="new-quantidade"
                                        />
                                        <IncrementButton @click="increment_decrement($page.props.carrinho.pedido, produto, 1)">
                                            +
                                        </IncrementButton>
                                    </div>
                                    <div>
                                        <div class="text-blue text-lg font-bold">R${{ produto.valor*produto.quantidade }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-base text-right font-semibold">{{ produto.maximo }} em estoque</div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.carrinho.pedido" class="bg-white">
                <div class="grid px-4 py-4 grid-cols-2 gap-1 text-xl text-red-500 font-extrabold">
                    <div>
                        Total
                    </div>
                    <div class="text-right">
                        R$ {{$page.props.carrinho.total.toFixed(2)}}
                    </div>
                </div>
                <div class="row text-center px-4 py-4">
                    <a :href="'/pedidos/' + $page.props.carrinho.pedido.id + '/finalizar-pedido'" class="tems-center px-4 py-2 bg-red-500 border border-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-red-900 hover:bg-white focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-white active:bg-white-50 disabled:opacity-25 transition w-full h-20">
                        FINALIZAR COMPRA
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
    props: {
    },
    methods: {
        open_cart: function () {
            var carrinho = document.getElementById("cart");
            if (carrinho.getAttribute("open") == "true") {
                carrinho.setAttribute("open", "false");
            } else {
                carrinho.setAttribute("open", "true");
            }
        },
        increment_decrement: function (pedido, produto, valor) {
            produto._method = 'PUT';
            produto.soma = valor;
            this.$inertia.post('/pedidos/' + pedido.id, produto)
        },
        finalizar_compra: function (pedido) {
            this.$inertia.get('/pedidos/' + pedido.id + '/finalizar-pedido', pedido)
        },
}
}
</script>
