<script setup>
    import {useForm } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    const form = useForm({
        nome: '',
        valor: '',
        quantidade: '',
        categoria: '',
        descricao: '',
        imagem: '',
    });

    const formDelete = useForm({
        nome: '',
        id: '',
    });

</script>


<template>
    <AppLayout title="Meus produtos">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="relative flex justify-center bg-gray-100 dark:bg-gray-900">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.flash.message">
                                        <div class="flex">
                                            <p class="text-sm">{{ $page.props.flash.message }}</p>
                                        </div>
                                    </div>
                                    <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.errors.length">
                                        <div class="flex">
                                            <p class="text-sm">{{ $page.props.errors }}</p>
                                        </div>
                                    </div>
                                    <div class="row text-right mb-2">
                                        <PrimaryButton class="ml-4" @click="openModal()">
                                            Cadastrar novo produto
                                        </PrimaryButton>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Nome
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Valor
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Quantidade
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Categoria
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Descrição
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Ação
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            v-for="produto in produtos.data"
                                            :key="produto.id"
                                            class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ produto.nome }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ produto.valor }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ produto.quantidade }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div v-if="produto.categoria">
                                                        {{ produto.categoria.nome }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ produto.descricao }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <button @click="edit(produto)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                                    <button @click="deletar(produto)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 ml-1 rounded">Deletar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="px-6 pb-4 bg-white">
                                        <pagination :data="produtos" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form @submit.prevent="submit">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <InputLabel for="nome" value="Nome" />
                                <TextInput
                                    id="nome"
                                    v-model="form.nome"
                                    type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                    autocomplete="new-nome"
                                />
                                <InputError class="mt-2" v-if="$page.props.errors.nome" :message="$page.props.errors.nome[0]" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="valor" value="Valor" />
                                <TextInput
                                    id="valor"
                                    v-model="form.valor"
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                    autocomplete="new-valor"
                                />
                                <InputError class="mt-2" v-if="$page.props.errors.valor" :message="$page.props.errors.valor[0]" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="quantidade" value="Quantidade" />
                                <TextInput
                                    id="quantidade"
                                    v-model="form.quantidade"
                                    type="number"
                                    step="1"
                                    min="1"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                    autocomplete="new-quantidade"
                                />
                                <InputError class="mt-2" v-if="$page.props.errors.quantidade" :message="$page.props.errors.quantidade[0]" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="categoria" value="Categoria" />
                                <select id="categoria"
                                    v-model="form.categoria"
                                    type="select"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="categoria" >
                                    <option disabled value=0>Selecione a categoria do produto</option>
                                    <option v-for="categoria in categorias" :value="categoria.id">{{ categoria.nome }}</option>
                                </select>
                                <InputError class="mt-2" v-if="$page.props.errors.categoria" :message="$page.props.errors.categoria[0]" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="descricao" value="Descrição" />
                                <textarea
                                    id="descricao"
                                    v-model="form.descricao"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required >
                                </textarea>
                                <InputError class="mt-2" v-if="$page.props.errors.descricao" :message="$page.props.errors.descricao[0]" />
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button v-show="!editMode" @click="save(form)" type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Salvar
                                </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button v-show="editMode" @click="update(form)" type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Atualizar
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancelar
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isDelete">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form @submit.prevent="submit">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                Tem certeza que deseja deletar o produto {{formDelete.nome}}
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button v-show="!editMode && !isOpen" @click="destroy(formDelete)" type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Deletar
                                </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                <button @click="closeDelete()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancelar
                                </button>
                            </span>
                        </div>
                    </form>
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
      categorias: Object,
    },
    data() {
            return {
                editMode: false,
                isOpen: false,
                isDelete: false,
                form: {
                    nome: null,
                    valor: null,
                    quantidade: null,
                    categoria: null,
                    descricao: null,
                },
                formDelete: {
                    nome: null,
                    id: null,
                }
            }
        },
        methods: {
            openModal: function () {
                this.isOpen = true;
            },
            closeModal: function () {
                this.reset();
                this.isOpen = false;
                this.editMode=false;
            },
            closeDelete: function () {
                this.isDelete = false;
                this.formDelete = {
                    nome: null,
                }
            },
            save: function (produto) {
                this.$inertia.post('/produtos', produto)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
            reset: function () {
                this.form = {
                    nome: null,
                    valor: null,
                    quantidade: null,
                    categoria: 0,
                    descricao: null,
                }
            },
            edit: function (produto) {
                this.form = Object.assign({}, produto);
                this.editMode = true;
                this.openModal();
            },
            deletar: function (produto) {
                this.formDelete = Object.assign({}, produto);
                this.isDelete = true;
            },
            update: function (produto) {
                produto._method = 'PUT';
                this.$inertia.post('/produtos/' + produto.id, produto)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
            destroy: function (produto) {
                produto._method = 'DELETE';
                this.$inertia.delete((route('produtos.destroy', produto.id)))
                this.reset();
                this.closeModal();
                this.closeDelete();
            }
        }
    }
</script>
