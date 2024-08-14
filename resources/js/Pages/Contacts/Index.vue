<template>
  <AppLayout title="Contactos">
    <!-- Card Item Start -->
    <div
      class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5"
    >
      <div
        v-for="(item, index) in cardItems"
        :key="index"
        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow bg-transparent dark:bg-transparent dark:border-gray-700"
      >
        <div class="flex justify-center align-middle" v-html="item.icon"></div>
        <h5
          class="mb-2 text-3xl font-bold tracking-tight text-black dark:text-blue-500"
        >
          {{ item.title }}
        </h5>
        <span class="text-2xl font-semibold text-gray-900 dark:text-white">{{
          item.total
        }}</span>
      </div>
    </div>
    <!-- Card Item End -->
    <div class="relative overflow-x-auto">
      <div class="w-full my-12 mx-auto flex justify-around">
        <SeachFilter
          v-model="form.search"
          class="mr-4 w-full max-w-md"
          @reset="reset"
        />
        <div class="flex items-center">
          <select
            v-model="form.perPage"
            class="mr-4 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-blue-500 focus:ring-1"
          >
            <option value="20">20</option>
            <option value="40">40</option>
            <option value="100">100</option>
            <option value="300">300</option>
            <option value="500">500</option>
          </select>
          <Link
            :href="route('contacts.create')"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            <span class="ms-2">Crear contacto</span>
            <svg
              class="w-4 h-4 ml-2"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9"
              />
            </svg>
          </Link>
        </div>
      </div>

      <table
        class="w-full text-sm p-6 text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3 text-left">Delete</th>
            <th scope="col" class="px-6 py-3 text-left">Nombre</th>
            <th scope="col" class="px-6 py-3 text-left">Telefono</th>
            <th scope="col" class="px-6 py-3 text-left">Ciudad</th>
            <th scope="col" class="px-6 py-3 text-left">Organizacion</th>
            <th scope="col" class="px-6 py-3 text-left">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="contact in contacts.data"
            :key="contact.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <td class="px-6 py-4">
              <button
                @click="deleteItem(contact.id)"
                class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 7l16 0" />
                  <path d="M10 11l0 6" />
                  <path d="M14 11l0 6" />
                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
              </button>
            </td>
            <td class="px-6 py-4">{{ contact.full_name }}</td>
            <td class="px-6 py-4">{{ contact.phone }}</td>
            <td class="px-6 py-4">{{ contact.city }}</td>
            <td class="px-6 py-4">{{ contact.organization }}</td>
            <td class="px-6 py-4">
              <Link
                :href="route('contacts.edit', contact.id)"
                class="cursos-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9"
                  />
                </svg>
              </Link>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="flex justify-center items-center mt-4">
        <nav aria-label="Page navigation example">
          <ul class="flex items-center -space-x-px h-10 text-base">
            <template v-for="link in contacts.links" :key="link.label">
              <li v-if="link.url !== null" class="flex">
                <Link
                  :href="link.url ? link.url : '#'"
                  :class="[
                    'flex items-center justify-center px-4 h-10 leading-tight border border-gray-300',
                    link.active
                      ? 'text-blue-600 bg-blue-50 border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                      : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                    link.label.includes('Previous') ? 'rounded-s-lg' : '',
                    link.label.includes('Next') ? 'rounded-e-lg' : '',
                  ]"
                >
                  <span
                    v-if="
                      link.label.includes('Previous') ||
                      link.label.includes('Next')
                    "
                    class="sr-only"
                    >{{ link.label }}</span
                  >
                  <template
                    v-if="
                      link.label.includes('Previous') ||
                      link.label.includes('Next')
                    "
                  >
                    <svg
                      class="w-3 h-3 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 6 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        :d="
                          link.label.includes('Previous')
                            ? 'M5 1 1 5l4 4'
                            : 'm1 9 4-4-4-4'
                        "
                      />
                    </svg>
                  </template>
                  <template v-else>{{ link.label }}</template>
                </Link>
              </li>
            </template>
          </ul>
        </nav>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SeachFilter from "@/Components/SearchFilter.vue";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";

export default {
  components: {
    AppLayout,
    Link,
    Head,
    SeachFilter,
  },
  props: {
    filters: Object,
    contacts: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search || "",
        perPage: this.filters.perPage || 20,
      },
      cardItems: [
        {
          icon: `<svg  xmlns="http://www.w3.org/2000/svg"  width="62"  height="62"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>`,
          title: "Total Contact",
          total: this.contacts.total,
          growthRate: 0.43,
        },
        {
          icon: `<svg  xmlns="http://www.w3.org/2000/svg"  width="62"  height="62"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>`,
          title: "Total Profit",
          total: "$45,2K",
          growthRate: 4.35,
        },
        {
          icon: `<svg  xmlns="http://www.w3.org/2000/svg"  width="62"  height="62"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>`,
          title: "Total Product",
          total: "2.450",
          growthRate: 2.59,
        },
        {
          icon: `<svg  xmlns="http://www.w3.org/2000/svg"  width="62"  height="62"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>`,
          title: "Total Users",
          total: "3.456",
          growthRate: -0.95,
        },
      ],
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function (newVal, oldVal) {
        this.$inertia.get("/contacts", pickBy(newVal), {
          preserveState: true,
        });
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },

    deleteItem(id) {
      this.$inertia.delete(route("contacts.destroy", id));
    },
  },
};
</script>