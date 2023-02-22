const { createApp } = Vue;

createApp({
    data() {
        return {
            apiUrl: './api.php',
            students: [],
            singleStudent: null
        };
    },
    methods: {
        getStudentInfo(index) {
            axios
                .get(this.apiUrl, {
                    params: {
                        student: index
                    }
                }) // http://localhost/67-lc-php-api/api.php?student=3
                .then((response) => {
                    console.log(response);
                    this.singleStudent = response.data.student;
                });
        }
    },
    created() {
        axios
            .get(this.apiUrl)
            .then((response) => {
                console.log(response);
                this.students = response.data.students;
            });
    }
}).mount('#app');