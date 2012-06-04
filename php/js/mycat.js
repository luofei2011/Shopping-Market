function SetCookie (name, value)  //设置名称为name,值为value的Cookie
{var expdate = new Date();
expdate.setTime(expdate.getTime() + 30 * 60 * 1000);
document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
alert("添加商品"+name+"成功!");
var cat=window.open("ShoppingCart.php","cat","toolbar=no,menubar=no,location=no,status=no,width=420,height=280"); //打开一个新窗口来显示统计的商品信息，即显示“手推车”} 
}
function Deletecookie (name) {  //删除名称为name的Cookie
var exp = new Date();  
    exp.setTime (exp.getTime() - 1);  
    var cval = GetCookie (name);  
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
function Clearcookie()   //清除COOKIE
    {
    var temp=document.cookie.split(";");
    var loop3;
    var ts;
    for (loop3=0;loop3<temp.length;loop3++)
        {
        ts=temp[loop3].split("=")[0];
        if (ts.indexOf('mycat')!=-1)
            DeleteCookie(ts);     //如果ts含“mycat”则执行清除
        } 
    }

function getCookieVal (offset) {       //取得项名称为offset的cookie值
    var endstr = document.cookie.indexOf (";", offset);  
    if (endstr == -1)
        endstr = document.cookie.length;  
        return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {  //取得名称为name的cookie值
        var arg = name + "=";  
        var alen = arg.length;  
        var clen = document.cookie.length;  
        var i = 0;  
        while (i < clen) {    
        var j = i + alen;    
        if (document.cookie.substring(i, j) == arg)      
                return getCookieVal (j);    
                i = document.cookie.indexOf(" ", i) + 1;    
                if (i == 0) break;   
        }  
        return null;
}
