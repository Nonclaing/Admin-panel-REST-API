"use strict";(self["webpackChunksport_club"]=self["webpackChunksport_club"]||[]).push([[654],{5403:function(t,e,o){o.d(e,{$G:function(){return i},Nr:function(){return n},cl:function(){return s},jX:function(){return c},lK:function(){return p},ol:function(){return r}});const n=t=>{const{dispatch:e}=t;e("typeofsport/fetchItems")},r=t=>{const{getters:e}=t;return e["typeofsport/items"]},s=(t,e)=>{const{dispatch:o}=t;o("typeofsport/removeItem",e)},c=(t,{TypeOfSport:e})=>{const{dispatch:o}=t;o("typeofsport/addItem",{TypeOfSport:e})},i=(t,{id:e,TypeOfSport:o})=>{const{dispatch:n}=t;n("typeofsport/updateItem",{id:e,TypeOfSport:o})},p=(t,e)=>{const{getters:o}=t;return o["typeofsport/itemsByKey"][e]||{}}},9654:function(t,e,o){o.r(e),o.d(e,{default:function(){return O}});var n=o(3396);function r(t,e,o,r,s,c){const i=(0,n.up)("TypeOfSportList"),p=(0,n.up)("Layout");return(0,n.wg)(),(0,n.j4)(p,{title:"Виды спорта"},{default:(0,n.w5)((()=>[(0,n.Wm)(i)])),_:1})}var s=o(7817);const c={class:"list"},i={class:"btn-control"},p=(0,n.Uk)("Показать"),u=(0,n.Uk)("Изменить"),l=(0,n.Uk)("Удалить"),a=(0,n.Uk)("Создать");function f(t,e,o,r,s,f){const d=(0,n.up)("Btn"),m=(0,n.up)("Table"),y=(0,n.up)("RouterLink");return(0,n.wg)(),(0,n.iD)("div",c,[(0,n.Wm)(m,{headers:[{value:"id",text:"ID",type:"text"},{value:"TypeOfSport",text:"Вид спорта",type:"sort-link"},{value:"control",text:"Действие"}],items:r.items},{control:(0,n.w5)((({item:t})=>[(0,n._)("div",i,[(0,n.Wm)(d,{onClick:e=>r.onClickSort(t.id),class:"link"},{default:(0,n.w5)((()=>[p])),_:2},1032,["onClick"]),(0,n.Wm)(d,{onClick:e=>r.onClickEdit(t.id),class:"info"},{default:(0,n.w5)((()=>[u])),_:2},1032,["onClick"]),(0,n.Wm)(d,{onClick:e=>r.onClickRemove(t.id),class:"danger"},{default:(0,n.w5)((()=>[l])),_:2},1032,["onClick"])])])),_:1},8,["items"]),(0,n.Wm)(y,{to:{name:"TypeOfSportEdit"}},{default:(0,n.w5)((()=>[(0,n.Wm)(d,{class:"list__create info"},{default:(0,n.w5)((()=>[a])),_:1})])),_:1})])}var d=o(65),m=o(678),y=o(5403),k=o(3371),v=o(8443),C={name:"TypeOfSportList",components:{Btn:v.Z,Table:k.Z},setup(){const t=(0,d.oR)(),e=(0,m.tv)();return(0,n.bv)((()=>{(0,y.Nr)(t)})),{items:(0,n.Fl)((()=>(0,y.ol)(t))),onClickRemove:e=>{const o=confirm("Вы действительно хотите удалить запись?");o&&(0,y.cl)(t,e)},onClickEdit:t=>{e.push({name:"TypeOfSportEdit",params:{id:t}})},onClickSort:t=>{e.push({name:"Sportsmans",params:{type_id:t}})}}}},S=o(89);const T=(0,S.Z)(C,[["render",f]]);var _=T,h={name:"TypeOfSportPage",components:{Layout:s.Z,TypeOfSportList:_}};const w=(0,S.Z)(h,[["render",r]]);var O=w}}]);
//# sourceMappingURL=654.55d830c7.js.map