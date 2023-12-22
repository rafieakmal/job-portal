<template>
    <section>
        <NavBar/>
        <BreadCrumb :title="job.title"/>
        <Detail :job="job"/>
        <MyFooter/>
    </section>
</template>

<script>
    import Detail from '../components/home/Detail.vue'
    import BreadCrumb from '../components/home/BreadCrumb.vue'
    import NavBar from '../components/public/Navbar.vue'
    import MyFooter from '../components/public/Footer.vue'

    import timesago from 'timesago'
    export default {
        metaInfo: {
            title: "MRI Job Portal - Job Detail",
        },
        components: { NavBar, MyFooter, Detail, BreadCrumb },
        name: 'detail-page',
        data() {
            return {
                job: {
                    title: 'Test Job',
                    description: '<p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>',
                    salary: this.formatRupiah(10000000),
                    level: 'Entry Level',
                    location: 'Jakarta',
                    type: 'Full Time',
                    created_at: timesago(new Date() - 1000 * 60 * 60 * 2),
                    image: '/assets/img/illustrations/12285799_4925138.svg',
                    requirements: '<p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>',
                    qualifications: '<p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>'
                }
            }
        },
        methods: {
            formatRupiah(number) {
                return number.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
            },
        }
    }
</script>