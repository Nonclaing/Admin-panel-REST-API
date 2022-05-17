"use strict";(self["webpackChunksport_club"]=self["webpackChunksport_club"]||[]).push([[622],{1472:function(e,t,o){o.d(t,{Qm:function(){return r},UW:function(){return i},YV:function(){return l},a1:function(){return n}});const r=e=>{const{dispatch:t}=e;t("sportsmans/fetchItems")},l=(e,t="")=>{const{getters:o}=e;return t?o["sportsmans/itemsByType"][t]||{}:o["sportsmans/items"]},i=(e,t)=>{const{dispatch:o}=e;o("sportsmans/removeItem",t)},n=(e,t)=>{const{getters:o}=e;return o["sportsmans/itemsByKey"][t]||{}}},5403:function(e,t,o){o.d(t,{AY:function(){return s},CI:function(){return i},Mr:function(){return a},Nr:function(){return r},WR:function(){return n},ol:function(){return l}});const r=e=>{const{dispatch:t}=e;t("typeofsport/fetchItems")},l=e=>{const{getters:t}=e;return t["typeofsport/items"]},i=(e,t)=>{const{getters:o}=e;return o["typeofsport/itemsByKey"][t]||{}},n=(e,t)=>{const{dispatch:o}=e;o("typeofsport/removeItem",t)},s=(e,{TypeOfSport:t})=>{const{dispatch:o}=e;o("typeofsport/addItem",{TypeOfSport:t})},a=(e,{id:t,TypeOfSport:o})=>{const{dispatch:r}=e;r("typeofsport/updateItem",{id:t,TypeOfSport:o})}},8443:function(e,t,o){o.d(t,{Z:function(){return c}});var r=o(3396);const l=["disabled"];function i(e,t,o,i,n,s){return(0,r.wg)(),(0,r.iD)("button",{disabled:o.disabled,class:"v-button"},[(0,r.WI)(e.$slots,"default")],8,l)}var n={name:"Btn",props:{theme:String,disabled:Boolean}},s=o(89);const a=(0,s.Z)(n,[["render",i]]);var c=a},7817:function(e,t,o){o.d(t,{Z:function(){return d}});var r=o(3396),l=o(7139);const i={class:"layout"},n={key:0,class:"layout__title"},s={class:"layout__content"};function a(e,t,o,a,c,p){return(0,r.wg)(),(0,r.iD)("div",i,[o.title?((0,r.wg)(),(0,r.iD)("h1",n,(0,l.zw)(o.title),1)):(0,r.kq)("",!0),(0,r._)("div",s,[(0,r.WI)(e.$slots,"default")])])}var c={name:"Layout",props:{title:{type:String}}},p=o(89);const u=(0,p.Z)(c,[["render",a]]);var d=u},6622:function(e,t,o){o.r(t),o.d(t,{default:function(){return pe}});var r=o(3396);function l(e,t,o,l,i,n){const s=(0,r.up)("SportsmansForm"),a=(0,r.up)("Layout");return(0,r.wg)(),(0,r.j4)(a,{title:o.id?"Редактирование записи":"Создание записи"},{default:(0,r.w5)((()=>[(0,r.Wm)(s,{onSubmit:l.onSubmit,id:o.id},null,8,["onSubmit","id"])])),_:1},8,["title"])}var i=o(65),n=o(1472),s=o(7817),a=o(9242);const c={class:"form"},p={key:0,class:"form__item"},u=(0,r._)("div",{class:"form__label"},[(0,r._)("label",{for:"id"},"ID")],-1),d={class:"form__item"},m=(0,r._)("div",{class:"form__label"},[(0,r._)("label",{for:"Name"},"ФИО")],-1),_={class:"form__item"},f={class:"form__item"},v=(0,r._)("div",{class:"form__label"},[(0,r._)("label",{for:"TypeOfSport"},"Вид спорта")],-1),h={class:"form__item"},y=(0,r._)("div",{class:"form__label"},[(0,r._)("label",{for:"Biography"},"Биография")],-1),g={class:"form__item"},b=(0,r._)("div",{class:"form__label"},[(0,r._)("label",{for:"Year"},"Год начала карьеры")],-1),w={class:"form__item"},S=(0,r.Uk)("Сохранить");function I(e,t,o,l,i,n){const s=(0,r.up)("v-file"),I=(0,r.up)("Select"),F=(0,r.up)("Btn");return(0,r.wg)(),(0,r.iD)("div",c,[l.form.id?((0,r.wg)(),(0,r.iD)("div",p,[u,(0,r.wy)((0,r._)("input",{"onUpdate:modelValue":t[0]||(t[0]=e=>l.form.id=e),disabled:"",class:"form__input",id:"id",placeholder:"id",type:"text"},null,512),[[a.nr,l.form.id]])])):(0,r.kq)("",!0),(0,r._)("div",d,[m,(0,r.wy)((0,r._)("input",{"onUpdate:modelValue":t[1]||(t[1]=e=>l.form.Name=e),class:"form__input",id:"Name",placeholder:"ФИО",type:"text"},null,512),[[a.nr,l.form.Name]])]),(0,r._)("div",_,[(0,r.Wm)(s,{title:"Фотография",placeholder:"Фотография",name:"photo",value:l.form.photo,onChangeFile:l.previewFiles,onClear:l.clearFile},null,8,["value","onChangeFile","onClear"])]),(0,r._)("div",f,[v,(0,r.Wm)(I,{modelValue:l.form.TYPE_OF_SPORT_ID,"onUpdate:modelValue":t[2]||(t[2]=e=>l.form.TYPE_OF_SPORT_ID=e),class:"form__select",name:"TypeOfSport",id:"TypeOfSport",selectID:l.form.TYPE_OF_SPORT_ID,items:l.typeOfSportList},null,8,["modelValue","selectID","items"])]),(0,r._)("div",h,[y,(0,r._)("input",{onChange:t[3]||(t[3]=(...e)=>l.previewFiles&&l.previewFiles(...e)),class:"form__input",id:"Biography",placeholder:"Биография",type:"file"},null,32)]),(0,r._)("div",g,[b,(0,r.wy)((0,r._)("input",{"onUpdate:modelValue":t[4]||(t[4]=e=>l.form.Year=e),class:"form__input",id:"Year",placeholder:"Год",type:"date"},null,512),[[a.nr,l.form.Year]])]),(0,r._)("div",w,[(0,r.Wm)(F,{onClick:l.onClick,disabled:!l.isValid,class:"info"},{default:(0,r.w5)((()=>[S])),_:1},8,["onClick","disabled"])])])}var F=o(4870),D=o(678),O=o(5403),T=o(8443),P=o(7139);const k=["value"];function Y(e,t,o,l,i,n){return(0,r.wy)(((0,r.wg)(),(0,r.iD)("select",{"onUpdate:modelValue":t[0]||(t[0]=e=>l.selected=e),class:"select"},[((0,r.wg)(!0),(0,r.iD)(r.HY,null,(0,r.Ko)(o.items,(e=>((0,r.wg)(),(0,r.iD)("option",{key:e.id,value:e.id},(0,P.zw)(e.TypeOfSport),9,k)))),128))],512)),[[a.bM,l.selected]])}var V={name:"Select",props:{items:Array,selectID:Number},setup(e,{emit:t}){const o=(0,F.iH)(e.selectID);return{selected:o}}},C=o(89);const B=(0,C.Z)(V,[["render",Y]]);var N=B;const R=e=>((0,r.dD)("data-v-71c73d0b"),e=e(),(0,r.Cn)(),e),Z={class:"file"},E={class:"file__label"},U=["for"],W={class:"file__body"},L={class:"file__control"},j={class:"file__choose"},x={class:"file__name"},z={key:0},H={key:1},$=["id","placeholder"],q={class:"file__clear-button"},K=R((()=>(0,r._)("span",null,"✖",-1))),A=[K],M={class:"file__preview"};function Q(e,t,o,l,i,n){const s=(0,r.up)("VImage");return(0,r.wg)(),(0,r.iD)("div",Z,[(0,r._)("div",E,[(0,r._)("label",{for:o.name},(0,P.zw)(o.title),9,U)]),(0,r._)("div",W,[(0,r._)("div",L,[(0,r._)("div",j,[(0,r._)("div",x,[o.value?((0,r.wg)(),(0,r.iD)("span",z,(0,P.zw)(o.value.replace("/files/","")),1)):((0,r.wg)(),(0,r.iD)("span",H,"Файл не выбран"))]),(0,r._)("input",{onInput:t[0]||(t[0]=(...e)=>l.previewFiles&&l.previewFiles(...e)),class:"file__input",id:o.name,placeholder:o.placeholder,type:"file",ref:"fileInput"},null,40,$)]),(0,r._)("div",q,[(0,r._)("a",{onClick:t[1]||(t[1]=(...e)=>l.clearFile&&l.clearFile(...e))},A)])]),(0,r._)("div",M,[(0,r.Wm)(s,{photo:l.previewPhoto,alt:"Превью фота"},null,8,["photo"])])])])}const G=["src","alt"];function J(e,t,o,l,i,n){return(0,r.wg)(),(0,r.iD)("div",{class:"image",style:(0,P.j5)({width:o.width+"px",height:o.height+"px"})},[(0,r.wy)((0,r._)("img",{class:"image__photo",src:o.photo,alt:o.alt},null,8,G),[[a.F8,o.photo]])],4)}var X={name:"VImage",props:{photo:String,alt:String,width:Number,height:Number},setup(e){}};const ee=(0,C.Z)(X,[["render",J],["__scopeId","data-v-3a82e0ac"]]);var te=ee,oe={name:"VFile",components:{VImage:te},props:{title:String,name:String,placeholder:String,value:String},setup(e,t){let o=e.value;const l=(0,F.iH)(null),i=(0,F.iH)("");function n(e){e.target.files[0]?(i.value=URL.createObjectURL(e.target.files[0]),t.emit("changeFile",e)):s()}function s(){console.log(o),l.value.value="",i.value="",t.emit("clear","true")}return(0,r.m0)((()=>{""!==e.value&&""===i.value&&(i.value="https://guselnikov.ivsand.ru"+e.value)})),{previewFiles:n,clearFile:s,fileInput:l,previewPhoto:i}}};const re=(0,C.Z)(oe,[["render",Q],["__scopeId","data-v-71c73d0b"]]);var le=re,ie={name:"SportsmansForm",props:{id:{type:String,default:""}},components:{VFile:le,Select:N,Btn:T.Z},setup(e,t){const o=(0,i.oR)(),l=(0,D.tv)(),s=(0,F.qj)({id:"",Name:"",Photo:"",TYPE_OF_SPORT_ID:1,Biography:"",Year:""}),a=(0,r.Fl)((()=>{for(const[e,t]of Object.entries(s))if("id"!==e&&!t)return!1;return!0})),c=e=>{s[`${e.target.id}`]=`/assets/photos/${e.target.files[0].name}`};return(0,r.wF)((()=>{(0,n.Qm)(o),(0,O.Nr)(o)})),(0,r.m0)((()=>{const t=(0,n.a1)(o,e.id);Object.keys(t).forEach((e=>{s[e]=t[e]}))})),{form:s,isValid:a,previewFiles:c,typeOfSportList:(0,r.Fl)((()=>(0,O.ol)(o))),onClick:()=>{t.emit("submit",s),l.push({name:"Sportsmans"})},clearFile:e=>{s.photo=""}}}};const ne=(0,C.Z)(ie,[["render",I]]);var se=ne,ae={name:"SportsmansEdit",props:{id:String},components:{Layout:s.Z,SportsmansForm:se},setup(){const e=(0,i.oR)();return{onSubmit:({id:t,Name:o,Photo:r,TYPE_SPORT_ID:l,Biography:i,Year:s})=>t?(0,n.updateItem)(e,{id:t,Name:o,Photo:r,TYPE_SPORT_ID:l,Biography:i,Year:s}):(0,n.addItem)(e,{Name:o,Photo:r,TYPE_SPORT_ID:l,Biography:i,Year:s})}}};const ce=(0,C.Z)(ae,[["render",l]]);var pe=ce}}]);
//# sourceMappingURL=622.16860aa0.js.map