import{d as m,x as p,f as a,m as s,F as l,n as d,y as u,i as f,z as i,B as k,C as y}from"./app-CIkqkhwh.js";const g=m({__name:"skeleton",props:{animated:{type:Boolean,default:!1},count:{type:Number,default:1},rows:{type:Number,default:3},loading:{type:Boolean,default:!0},throttle:{type:Number}},setup(e,{expose:n}){const o=p(e,"loading");return n({uiLoading:o}),(t,B)=>o.value?(a(),s("div",i({key:0,class:"hx-skeleton is-animated"},t.$attrs),[(a(!0),s(l,null,d(e.count,r=>(a(),s(l,{key:r},[e.loading?u(t.$slots,"template",{key:r}):f("",!0)],64))),128))],16)):u(t.$slots,"default",k(i({key:1},t.$attrs)))}}),h=m({__name:"skeleton-item",props:{variant:{type:String,values:["circle","rect","h1","h3","text","caption","p","image","button","card"],default:"text"}},setup(e){return(n,c)=>(a(),s("div",{class:y(["hx-skeleton__item",[`hx-skeleton__${e.variant}`]])},null,2))}}),v=g,x=h;export{x as B,v as a};
