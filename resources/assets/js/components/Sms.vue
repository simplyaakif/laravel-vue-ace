<template>
    <div>
        <h2 class="text-center">Send Messages</h2>
        <p class="text-center">Message or Email anyone via this form</p>
        <div class="br-section-wrapper">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Send Text Message</h6>
                <p class="mg-b-30 tx-gray-600">A basic form to send Branded Sms.</p>
                <div class="row">
                  <label class="col-sm-2 form-control-label">Number: <span class="tx-danger">*</span></label>
                  <div class="col-sm-10 mg-t-10 mg-sm-t-0">
                    <input type="text" v-model="sms.sms_mobile" v-mask="'####-#######'" class="form-control" placeholder="Enter Mobile Number i.e 0300-0000000">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-2 form-control-label">Message: <span class="tx-danger">*</span></label>
                  <div class="col-sm-10 mg-t-10 mg-sm-t-0">
                    <textarea rows="8" v-model="sms.sms_message" class="form-control" placeholder="Enter your message"></textarea>
                  </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                  <button  class="btn btn-info" @click="sendsms()">Submit Sms</button>
                  <button class="btn btn-secondary">Cancel</button>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div>

            <div class="col-xl-12 mg-t-8">
              <div class="form-layout form-layout-4">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Send Email Message</h6>
                <p class="mg-b-30 tx-gray-600">A basic form to send Branded Email.</p>
                <div class="row">
                  <label class="col-sm-2 form-control-label">Email Address: <span class="tx-danger">*</span></label>
                  <div class="col-sm-10 mg-t-10 mg-sm-t-0">
                    <input type="email" v-model="sms.sms_email" class="form-control" placeholder="Enter email address">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-2 form-control-label">Message: <span class="tx-danger">*</span></label>
                  <div class="col-sm-10 mg-t-10 mg-sm-t-0">
                    <textarea rows="8" v-model="sms.sms_message" class="form-control" placeholder="Enter your message"></textarea>
                  </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                  <button  class="btn btn-info" @click="sendemail()">Submit Email</button>
                  <button class="btn btn-secondary">Cancel</button>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            sms:{
                sms_mobile:'',
                sms_email:'',
                sms_message:'',
            }
        };
    },
    methods: {
        sendsms(){
            fetch('api/sms-email', {
                method: 'post',
                body: JSON.stringify(this.sms),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
            console.log(data);
            alert('Sms Sent');
            this.sms.sms_mobile = '';
            this.sms.sms_message = '';
          })
          .catch(err => console.log(err));
        },
        sendemail(){
            fetch('api/sms-email', {
                method: 'post',
                body: JSON.stringify(this.sms),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
            alert('Email Sent');
            this.sms.sms_email = '';
            this.sms.sms_message = '';
          })
          .catch(err => console.log(err));
        },
    }
}
</script>

<style lang="scss">

</style>
