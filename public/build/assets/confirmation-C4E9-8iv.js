import{d as x,r as w,o as y,m as c,j as e,g as n,w as i,p as g,A as k,e as o,f as l,t as r}from"./app-CIkqkhwh.js";const b={class:"w-full min-h-screen h-screen flex items-center justify-center"},j=e("div",null,null,-1),B={key:0,class:"text-xl text-center text-green-700 font-weight-black mt-3"},C={key:1,class:"text-xl text-center text-red-600 font-weight-black mt-3"},A={class:"d-flex justify-space-between py-3 mt-3"},N=e("span",{class:"text-medium-emphasis"}," کد پیگیری‌ ",-1),S={class:"text-green-darken-3 font-weight-medium"},V={class:"d-flex justify-space-between py-3 mt-3"},D=e("span",{class:"text-medium-emphasis"}," مبلغ ",-1),E={class:"text-green-darken-3 font-weight-medium"},$=x({__name:"confirmation",setup(M){const t=w({}),m=g(),u=async()=>{const{data:d}=await k.get(`application/purchase/payment/confirmation/${m.params.id}`);t.value=d.data};return y(()=>{u()}),(d,P)=>{const p=o("v-card-text"),f=o("v-btn"),h=o("v-card-actions"),v=o("v-card");return l(),c("div",null,[e("div",b,[n(v,{class:"mx-auto","max-width":"500",width:"400"},{default:i(()=>[n(p,null,{default:i(()=>{var s,a,_;return[j,((s=t.value)==null?void 0:s.status)=="success"?(l(),c("p",B," پرداخت موفقیت آمیز ")):(l(),c("p",C," پرداخت ناموفق ")),e("div",A,[N,e("span",S,r((a=t.value)==null?void 0:a.reference_code),1)]),e("div",V,[D,e("span",E,r((_=t.value)==null?void 0:_.amount),1)])]}),_:1}),n(h,null,{default:i(()=>{var s,a;return[n(f,{to:{name:"panel-wallets-detail",params:{id:(a=(s=t.value)==null?void 0:s.invoice)==null?void 0:a.invoiceable_id}},color:"success",text:" کیف پول",variant:"tonal"},null,8,["to"])]}),_:1})]),_:1})])])}}});export{$ as default};