 <template> 
 
    <Row>
        <br>
        <Col span="6" offset="5">
            <Card style="width:800px">
            <div style="text-align:center">
                <img src="http://parsu-oscs.herokuapp.com/img/psulogo.png">
                <br><br>
                <h2>Faculty Video Conferencing Scheduler</h2>
                <br>
                <h3>You are entitled to have 5 slot. Each slot is 2 hours count. <br> There are 20 Slots per week.</h3>
            
            
            </div>
            <br>
            <div class="container"></div>
             <Row>
                <br>
                <Col span="20" offset="2">
            <Alert show-icon>This will only affect the connection on Zoom and Google Meet.</Alert>
            <div>
                <Form :model="facultyItem" :label-width="80">
            <FormItem label="Full Name">
                <Input v-model="facultyItem.name" prefix="ios-contact" placeholder="Enter your full name"/>
            
            </FormItem>
            <FormItem label="Department">
                <Select v-model="facultyItem.department" placeholder="Select your department"> 
                    <Option :value="d.id" v-for="(d, i) in departments" :key="i" v-if="departments.length">{{d.name}}</Option>
                </Select>
            </FormItem>
            <FormItem label="Slot No. 1">
                <Select v-model="facultyItem.firstSlot" placeholder="Select slot"> 
                    <Option :value="r.id" v-for="(r, i) in slots" :key="i" v-if="slots.length">{{r.day}} {{r.time}}</Option>
                </Select>
            </FormItem>
            <FormItem label="Slot No. 2">
                <Select v-model="facultyItem.secondSlot" placeholder="Select slot"> 
                    <Option :value="r.id" v-for="(r, i) in slots" :key="i" v-if="slots.length">{{r.day}} {{r.time}}</Option>
                </Select>
            </FormItem>
            <FormItem label="Slot No. 3">
                <Select v-model="facultyItem.thirdSlot" placeholder="Select slot"> 
                    <Option :value="r.id" v-for="(r, i) in slots" :key="i" v-if="slots.length">{{r.day}} {{r.time}}</Option>
                </Select>
            </FormItem>
            <FormItem label="Slot No. 4">
                <Select v-model="facultyItem.forthSlot" placeholder="Select slot"> 
                    <Option :value="r.id" v-for="(r, i) in slots" :key="i" v-if="slots.length">{{r.day}} {{r.time}}</Option>
                </Select>
            </FormItem>
            <FormItem label="Slot No. 5">
                <Select v-model="facultyItem.fifthSlot" placeholder="Select slot"> 
                    <Option :value="r.id" v-for="(r, i) in slots" :key="i" v-if="slots.length">{{r.day}} {{r.time}}</Option>
                </Select>
            </FormItem>
            
                    <FormItem>
                        <Button type="primary" @click="saveData">Submit</Button>
                        <Button style="margin-left: 8px">Cancel</Button>
                    </FormItem>
                </Form>
            </div>
               </Col> 
             </Row>
            </Card>
        </Col> 
    </Row>
</template>
<script>

    export default {
        data () {
            return {
                data: {
                    slot_id: null,
                },
                slots: [],
                departments: [],
                facultyItem: {
                    name: '',
                    department: '',
                    firstSlot: '',
                    secondSlot: '',
                    thirdSlot: '',
                    forthSlot: '',
                    fifthSlot: '',
                }
            }
        },
        methods : {
            async saveData(){
                if(this.facultyItem.name.trim()=='') return this.e('Full name is required')
                if(!this.facultyItem.department) return this.e('Department is required')
                if(!this.facultyItem.firstSlot) return this.e('Slot No. 1 is required')
                if(!this.facultyItem.secondSlot) return this.e('Slot No. 2 is required')
                if(!this.facultyItem.thirdSlot) return this.e('Slot No. 3 is required')
                if(!this.facultyItem.forthSlot) return this.e('Slot No. 4 is required')
                if(!this.facultyItem.fifthSlot) return this.e('Slot No. 5 is required')
               console.log(this.facultyItem.name);
                console.log(this.facultyItem.department);
                 console.log(this.facultyItem.firstSlot);
                  console.log(this.facultyItem.secondSlot);
                   console.log(this.facultyItem.thirdSlot);
                    console.log(this.facultyItem.forthSlot);
                     console.log(this.facultyItem.fifthSlot);
            },
        },
        async created() {
            // console.log(this.$route)
            // const res = await this.callApi('get', 'app/get_slots')
            // console.log(res);
            // if (res.status == 200) {
            // this.slots = res.data;
            // // if(res.data.length){
            // //     this.data.id = res.data[0].id
            // //     if(res.data[0].time){
            // //         this.resources = JSON.parse(res.data[0].time)
            // //         //this.resources = this.defaultResourcesPermission
            // // }
            // // }
            // } else {
            // this.swr();
            // }
            const [res, resDepartment] = await Promise.all([
			this.callApi('get', 'app/get_slots'), 
			this.callApi('get', 'app/get_departments')
            ])
            if(res.status==200){
                this.slots = res.data
            }else{
                this.swr()
            }
            if(resDepartment.status==200){
                this.departments = resDepartment.data
            }else{
                this.swr()
            }

        },

    }
    
</script>
   