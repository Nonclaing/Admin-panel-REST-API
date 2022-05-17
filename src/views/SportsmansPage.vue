<template>
  <Layout title="Спортсмены">
    <SportsmansList :filter_field="filter_field" :filter_value="filter_value" />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import SportsmansList from '@/components/SportsmansList/SportsmansList';

export default {
  name: 'Sportsmans',
  components: {
    Layout,
    SportsmansList,
  },
  props: {
    filter_field: String,
    filter_value: String,
  },
}
</script>
