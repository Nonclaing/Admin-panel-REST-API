<template>
  <Layout title="Виды спорта">
    <TypeOfSportList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import TypeOfSportList from '@/components/TypeOfSportList/TypeOfSportList';

export default {
  name: 'TypeOfSportPage',
  components: {
    Layout,
    TypeOfSportList,
  }
}
</script>

