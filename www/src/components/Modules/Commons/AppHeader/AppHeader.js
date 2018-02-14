import Headroom from 'headroom.js'
export default {
    name: 'AppHeader',
    data() {
        return {
            headroom: {},
            searchValue: '',
        }
    },
    methods: {
        onSearch(searchValue) {
            this.$router.push({
                path: '/search',
                query: {
                    title: searchValue,
                }
            })
        },
        initHeadroom() {
            this.headroom = new Headroom(this.$refs.header, {
                "tolerance": 1,
                "offset": 80,
                "classes": {
                    "initial": "animated",
                    "pinned": "bounceInDown",
                    "unpinned": "bounceOutUp"
                }
            })
            this.headroom.init()
        }
    },
    mounted() {
        this.initHeadroom()
    },
    destroyed() {
        this.headroom.destroy();
    }
}