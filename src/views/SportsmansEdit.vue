<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <SportsmansForm :id="id"  />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import SportsmansForm from "@/components/SportsmansForm/SportsmansForm";

export default {
  name: 'SportsmansEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    SportsmansForm,
  },
}
</script>

