import{d as k,r,u as h,m as C,g as t,w as l,b as j,e as s,f as U,k as u,j as c}from"./app-CIkqkhwh.js";const B={class:"login-card"},N=c("div",{class:"text-subtitle-1 text-medium-emphasis"},"ایمیل",-1),I=c("div",{class:"text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"}," رمز عبور ",-1),$=c("div",{class:"text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"}," تکرار رمز عبور ",-1),E=k({__name:"register",setup(z){const i=r(!1),p=h(),v=j(),o=r({email:"",password:"",password_confirmation:""}),a=r(!1),_=async()=>{const m={email:o.value.email,password:o.value.password,password_confirmation:o.value.password_confirmation};try{const e=await p.register(m);console.log("response data",e),e.status=="200"?v.push({name:"panel-dashboard"}):i.value=!0}catch{i.value=!0}};return(m,e)=>{const f=s("v-img"),d=s("v-text-field"),x=s("v-btn"),w=s("v-icon"),b=s("router-link"),g=s("v-card-text"),y=s("v-card"),V=s("v-snackbar");return U(),C("div",B,[t(f,{class:"mx-auto my-6","max-width":"128",src:"/panel/media/logo.jpg"}),t(y,{class:"mx-auto pa-12 pb-8",elevation:"8","max-width":"448",rounded:"lg"},{default:l(()=>[N,t(d,{modelValue:o.value.email,"onUpdate:modelValue":e[0]||(e[0]=n=>o.value.email=n),density:"compact",placeholder:"ایمیل را وارد کنید","prepend-inner-icon":"mdi-email-outline",variant:"outlined"},null,8,["modelValue"]),I,t(d,{modelValue:o.value.password,"onUpdate:modelValue":e[1]||(e[1]=n=>o.value.password=n),"append-inner-icon":a.value?"mdi-eye-off":"mdi-eye",type:a.value?"text":"password",density:"compact",placeholder:"رمز عبور خود را وارد کنید","prepend-inner-icon":"mdi-lock-outline",variant:"outlined","onClick:appendInner":e[2]||(e[2]=n=>a.value=!a.value)},null,8,["modelValue","append-inner-icon","type"]),$,t(d,{modelValue:o.value.password_confirmation,"onUpdate:modelValue":e[3]||(e[3]=n=>o.value.password_confirmation=n),"append-inner-icon":a.value?"mdi-eye-off":"mdi-eye",type:a.value?"text":"password_confirmation",density:"compact",placeholder:"رمز عبور خود را وارد کنید","prepend-inner-icon":"mdi-lock-outline",variant:"outlined","onClick:appendInner":e[4]||(e[4]=n=>a.value=!a.value)},null,8,["modelValue","append-inner-icon","type"]),t(x,{onClick:_,block:"",class:"mt-8",color:"blue",size:"large",variant:"tonal"},{default:l(()=>[u(" ادامه ")]),_:1}),t(g,{class:"text-center"},{default:l(()=>[t(b,{to:{name:"auth-login"},class:"text-blue text-decoration-none"},{default:l(()=>[t(w,{icon:"mdi-chevron-right"}),u(" ورود ")]),_:1})]),_:1})]),_:1}),t(V,{timeout:2e3,modelValue:i.value,"onUpdate:modelValue":e[5]||(e[5]=n=>i.value=n)},{default:l(()=>[u(" ایمیل و یا رمز عبور نادرست است. ")]),_:1},8,["modelValue"])])}}});export{E as default};
