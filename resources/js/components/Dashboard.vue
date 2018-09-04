<template>
    <div>
        <heading v-if="cards.length > 1" class="mb-6">{{__('Dashboard')}}</heading>

        <div v-if="shouldShowCards">
            <cards v-if="smallCards.length > 0" :cards="smallCards" class="mb-3"/>
            <cards v-if="largeCards.length > 0" :cards="largeCards" size="large"/>
        </div>
    </div>
</template>

<script>
import HasCards from 'laravel-nova/src/mixins/HasCards';

export default {
    mixins: [HasCards],

    props: {
        dashboardName: {
            type: String,
            required: false,
            default: 'main',
        },
    },

    watch: {
        cardsEndpoint() {
            this.fetchCards()
        }
    },

    computed: {
        /**
         * Get the endpoint for this dashboard's metrics.
         */
        cardsEndpoint() {
            return `/nova-vendor/AlexBowers/nova-multiple-dashboard/dashboards/${this.dashboardName}`
        },
    },
}
</script>
