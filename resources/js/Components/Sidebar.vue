<template>
  <FwbSidebar>
    <FwbSidebarDropdownItem>
      <template #icon>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="icon icon-tabler icons-tabler-filled icon-tabler-user"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
          <path
            d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z"
          />
        </svg>
      </template>
      <template #trigger> Contactos </template>
      <template #default>
        <FwbSidebarItem>
          <Link
            :href="route('contacts.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <span class="ms-3">Contactos</span>
          </Link>
        </FwbSidebarItem>
      </template>
    </FwbSidebarDropdownItem>
  </FwbSidebar>
</template>
  
  <script setup>
import { Link } from "@inertiajs/vue3";
import {
  FwbSidebar,
  FwbSidebarDropdownItem,
  FwbSidebarItem,
  FwbSidebarCta,
} from "flowbite-vue";
</script>