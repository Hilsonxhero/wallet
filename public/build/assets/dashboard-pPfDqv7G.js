import{d as x,r as h,o as g,m as c,j as t,F as b,n as y,A as k,e as n,f as d,g as e,w as a,t as o,k as j}from"./app-CIkqkhwh.js";const B={class:"grid grid-cols-12 gap-2"},C={class:"text-xl font-weight-black"},N={class:"text-medium-emphasis mt-2"},V={class:"d-flex justify-space-between py-3 mt-3"},A=t("span",{class:"text-medium-emphasis"}," موجودی ",-1),F={class:"text-green-darken-3 font-weight-medium"},E=x({__name:"dashboard",setup(S){const i=h([]),m=async()=>{const{data:r}=await k.get("application/user/wallets");i.value=r.data};return g(()=>{m()}),(r,l)=>{const p=n("v-card-text"),_=n("v-btn"),u=n("v-card-actions"),v=n("v-card");return d(),c("div",null,[t("div",B,[(d(!0),c(b,null,y(i.value,(s,f)=>(d(),c("div",{class:"col-span-4",key:f},[e(v,{class:"mx-auto","max-width":"344"},{default:a(()=>[e(p,null,{default:a(()=>[t("p",C,o(s==null?void 0:s.name),1),t("div",N,o(s==null?void 0:s.description),1),t("div",V,[A,t("span",F,o(s==null?void 0:s.balance),1)])]),_:2},1024),e(u,{class:"flex justify-between items-center"},{default:a(()=>[e(_,{to:{name:"panel-wallets-detail",params:{id:s==null?void 0:s.id}},text:"مدیریت کیف پول",variant:"text"},null,8,["to"]),e(_,{variant:"elevated",color:"#5865f2"},{default:a(()=>[j(o(s==null?void 0:s.type),1)]),_:2},1024)]),_:2},1024)]),_:2},1024)]))),128))])])}}});export{E as default};