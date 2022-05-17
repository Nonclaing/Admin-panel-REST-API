<template>
    <ul class="list-table">
      <li>
        <RouterLink :to="{ name: 'Sportsmans' }">Спортсмены</RouterLink>
      </li>
      <li>
        <RouterLink :to="{ name: 'TypeOfSport' }">Виды спорта</RouterLink>
      </li>
    </ul>
</template>

<script>
export default {
  name: 'ListTables'
}
</script>