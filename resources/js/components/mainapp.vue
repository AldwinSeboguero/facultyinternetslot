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
            <FormItem label="Select Slot">
                <i-select v-model="model10" multiple placeholder="Select exactly 5 slot">
                <i-option :disabled="true" :value="r.id" v-for="(r, i) in slots" :key="i" v-if="!r.available">{{r.day}} {{r.time}} | Full</i-option>
                <i-option :disabled="disable" :value="r.id" v-for="(r, i) in slots" :key="i" v-if="r.available">{{r.day}} {{r.time}}</i-option>
            </i-select>
            </FormItem>
            
                    <FormItem>
                        <Button type="primary" @click="saveSlot">Submit</Button>
                        <!-- <Button style="margin-left: 8px">Cancel</Button> -->
                         <Modal v-model="modal2" width="400">
                            <p slot="header" style="color:#2d8cf0;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Submit confirmation</span>
                            </p>
                            <div style="text-align:center">
                                <p>After this task is submitted, the 5 slot will reserve for you.</p>
                                <p>Will you submit it?</p>
                            </div>
                            <div slot="footer">
                                <Button type="info" size="large" long :loading="modal_loading" @click="saveData">Submit</Button>
                            </div>
                        </Modal>
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
                modal2: false,
                 modal_loading: false,
                disable:false,
                 max: 5,
                data: {
                    slot_id: null,
                },
                slots: [],
                departments: [],
                facultyItem: {
                    name: '',
                    department: '',
                },
                model10: [],
            }
        },
         watch: {
            model10(val) { 
                
            if (val.length == this.max) this.disable=true
            else this.disable=false
            }

            },
        methods : {
            saveSlot(){
                 if(this.facultyItem.name.trim()=='') return this.e('Full name is required')
                if(!this.facultyItem.department) return this.e('Department is required')
                if(this.model10.length == 0) return this.e('Slot is required')
                 if(this.model10.length < 2) return this.e('Please choose 4 more slot')
                 if(this.model10.length < 3) return this.e('Please choose 3 more slot') 
                 if(this.model10.length < 4) return this.e('Please choose 2 more slot')
                 if(this.model10.length < 5) return this.e('Please choose 1 more slot')
                 this.modal2 = true
            },
            async saveData(){
               
                // if(!this.facultyItem.secondSlot) return this.e('Slot No. 2 is required')
                // if(!this.facultyItem.thirdSlot) return this.e('Slot No. 3 is required')
                // if(!this.facultyItem.forthSlot) return this.e('Slot No. 4 is required')
                // if(!this.facultyItem.fifthSlot) return this.e('Slot No. 5 is required')
                  this.modal_loading = true;
                setTimeout(() => {
                    this.modal_loading = false;
                    this.modal2 = false;
                    this.$Message.success('Successfully delete');
                }, 2000);
                const res = await this.callApi('post','app/saveFacultySlot', {'facultyItem' : this.facultyItem,'slot' : this.model10})
                if(res.status==200){
                    // this.s('Slot has been assigned successfully!');
                    this.facultyItem.name = '';
                    this.facultyItem.department = '';
                    this.model10 = [];
                     window.location.href = 'success';

                }else{
                this.swr()
                }
               console.log(this.facultyItem.name);
                console.log(this.facultyItem.department);
                 console.log(this.model10.length); 
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
   