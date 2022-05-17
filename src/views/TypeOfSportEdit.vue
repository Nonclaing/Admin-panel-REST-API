<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <TypeOfSportForm
        :id="id"
    />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import TypeOfSportForm from '@/components/TypeOfSportForm/TypeOfSportForm';
export default {
  name: 'TypeOfSportEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    TypeOfSportForm,
  },
}
</script>

