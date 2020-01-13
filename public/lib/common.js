// 本文件封装了一些常用的跳转和ajax请求

// 延时跳转到另一个url
var navTo = function(url, time) {
  time = time || 1300;
  setTimeout(function() {
    window.open(url, '_self');
  }, time);
}

// 延时刷新页面
var refresh = function(time) {
  time = time || 1300;
  setTimeout(function() {
    window.location.reload();
  }, time);
}

// 延时后退
var goback = function(time) {
  time = time || 1300;
  setTimeout(function() {
    window.history.back(-1);
  }, time);
}

// 封装ajax 主要是为了在请求头中附带token
var request = function(query, callback) {
  var token = localStorage.getItem('map_token');
  $.ajax({
    type: query.method || 'get',
    url: query.url,
    dataType: 'json',
    data: query.data || {},
    //添加 bearer token
    headers: {'Authorization': 'Bearer ' + token},
    success: function (res, status) {
      status = status == 'success' ? 200 : status;
      callback.success(res, status);
    },
    error: function (err) {
      if (callback.error) {
        callback.error(err.responseJSON, err.status);
      } 
    },
    complete: function () {
      if (callback.complete) {
        callback.complete();
      } 
    }
  });
}