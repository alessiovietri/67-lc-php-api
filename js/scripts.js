const { createApp } = Vue;

createApp({
    data() {
        return {
            readUrl: './read.php',
            createUrl: './create.php',
            students: [],
            singleStudent: null,
            newStudent: {
                firstName: '',
                lastName: '',
                email: '',
            }
        };
    },
    methods: {
        getStudentInfo(index) {
            axios
                .get(this.readUrl, {
                    params: {
                        student: index
                    }
                }) // http://localhost/67-lc-php-api/api.php?student=3
                .then((response) => {
                    console.log(response);
                    this.singleStudent = response.data.student;
                });
        },
        addStudent() {
            console.log(this.newStudent);
            
            axios.post(this.createUrl, {
                student: this.newStudent
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then((response) => {
                console.log(response);

                this.students.push({
                    full_name: this.newStudent.firstName + ' ' + this.newStudent.lastName
                });

                this.newStudent.firstName = '';
                this.newStudent.lastName = '';
                this.newStudent.email = '';
            });
        }
    },
    created() {
        axios
            .get(this.readUrl)
            .then((response) => {
                console.log(response);
                this.students = response.data.students;
            });
    }
}).mount('#app');