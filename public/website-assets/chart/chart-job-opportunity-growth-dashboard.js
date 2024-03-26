(() => {
    function t(t, e) {
        for (var a = 0; a < e.length; a++) {
            var o = e[a];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }
    var e = function() {
        function e() {
            ! function(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e), this.data = null, this.ctx = null, this.myChart = null, this.dataKey = [], this.dataValue = []
        }
        var a, o, i;
        return a = e, (o = [{
            key: "init",
            value: function(t) {
                this.initCtx(), this.initData(t), this.initMyChart(), this.loadChartJobOpportunityGrowthDashboard()
            }
        }, {
            key: "checkTimeDistance",
            value: function(t, e, a) {
                return Math.abs(t - e) >= 6e4 * a
            }
        }, {
            key: "getDataJobOpportunityGrowthLocalStorage",
            value: function() {
                var t = localStorage.getItem("data_job_opportunity_growth");
                return t ? (t = JSON.parse(t), this.checkTimeDistance(t.timestamp, (new Date).getTime(), 5) ? null : t.data) : null
            }
        }, {
            key: "fillDataJobOpportunityGrowth",
            value: function(t) {
                $("#dashboard-section .block-chart .loading-chart").css("display", "none"), $("#dashboard-section .block-chart .box-chart").css("display", "block"), setTimeout((function() {
                    window.ChartJobOpportunityGrowthDashboard && window.ChartJobOpportunityGrowthDashboard.update(t)
                }), 100)
            }
        }, {
            key: "loadChartJobOpportunityGrowthDashboard",
            value: function() {
                var t = this,
                    e = this.getDataJobOpportunityGrowthLocalStorage();
                null != e && this.fillDataJobOpportunityGrowth(e), $.ajax({
                    url: app.home.jobOpportunityGrowth,
                    type: "get",
                    success: function(a) {
                        if ("success" == a.status) {
                            var o = a.data,
                                i = {
                                    data: o,
                                    timestamp: (new Date).getTime()
                                };
                            localStorage.setItem("data_job_opportunity_growth", JSON.stringify(i)), null == e && t.fillDataJobOpportunityGrowth(o)
                        } else console.log("failed!")
                    },
                    error: function(t) {
                        console.log("failed!")
                    }
                })
            }
        }, {
            key: "update",
            value: function(t) {
                this.initData(t), this.myChart.data = {
                    labels: this.dataKey,
                    datasets: [{
                        data: this.dataValue,
                        borderColor: "#00B14F",
                        fill: !1,
                        tension: .3,
                        pointBackgroundColor: "#00B14F",
                        pointBorderColor: "#00B14F",
                        pointRadius: 1
                    }]
                }, this.myChart.update()
            }
        }, {
            key: "initCtx",
            value: function() {
                this.ctx = document.getElementById("myChartJobOpportunityGrowthDashboard").getContext("2d")
            }
        }, {
            key: "initMyChart",
            value: function() {
                this.myChart = new Chart(this.ctx, {
                    type: "line",
                    data: {
                        labels: this.dataKey,
                        datasets: [{
                            data: this.dataValue,
                            borderColor: "#00B14F",
                            fill: !1,
                            tension: .3,
                            pointBackgroundColor: "#00B14F",
                            pointBorderColor: "#00B14F",
                            pointRadius: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: !1,
                        responsive: !0,
                        plugins: {
                            title: {
                                display: !1
                            },
                            legend: {
                                display: !1
                            },
                            tooltip: {
                                enabled: !1,
                                position: "nearest",
                                padding: 8,
                                fontFamily: "Inter",
                                external: function(t) {
                                    var e = t.chart,
                                        a = t.tooltip,
                                        o = e.canvas.parentNode.querySelector("div");
                                    if (!o) {
                                        (o = document.createElement("div")).style.opacity = 1, o.style.pointerEvents = "none", o.style.position = "absolute", o.style.transform = "translate(-50%, 0)", o.style.transition = "all .3s ease";
                                        var i = document.createElement("div");
                                        i.classList.add("chartjs-tooltip-caret"), i.style.width = "0", i.style.height = "0", i.style.borderBottomWidth = "".concat(a.options.caretSize, "px"), i.style.borderBottomStyle = "solid", i.style.borderBottomColor = "#212F3F", i.style.borderRightWidth = "".concat(a.options.caretSize, "px"), i.style.borderRightStyle = "solid", i.style.borderRightColor = "transparent", i.style.borderLeftWidth = "".concat(a.options.caretSize, "px"), i.style.borderLeftStyle = "solid", i.style.borderLeftColor = "transparent", i.style.margin = "0 auto", o.appendChild(i);
                                        var r = document.createElement("table");
                                        r.style.margin = "0px", o.appendChild(r), e.canvas.parentNode.appendChild(o)
                                    }
                                    if (0 !== a.opacity) {
                                        if (a.body) {
                                            var n = a.title || [],
                                                l = a.body.map((function(t) {
                                                    return t.lines
                                                })),
                                                s = document.createElement("thead");
                                            s.style.marginBottom = "3px", s.style.display = "block", n.forEach((function(t) {
                                                var e = document.createElement("tr");
                                                e.style.borderWidth = 0;
                                                var a = document.createElement("td");
                                                a.style.borderWidth = 0, a.style.fontWeight = 400, a.style.fontSize = "12px";
                                                var o = document.createTextNode(t);
                                                a.appendChild(o), e.appendChild(a), s.appendChild(e)
                                            }));
                                            var d = document.createElement("tbody");
                                            l.forEach((function(t, e) {
                                                var a = document.createElement("tr");
                                                a.style.backgroundColor = "inherit", a.style.borderWidth = 0;
                                                var o = document.createElement("td");
                                                o.style.borderWidth = 0, o.style.fontWeight = "bold", o.style.fontSize = "15px", t = t.toLocaleString("en-US", {
                                                    minimumFractionDigits: 3
                                                }).replace(/,/g, ".");
                                                var i = document.createTextNode(t + " việc làm");
                                                o.appendChild(i), a.appendChild(o), d.appendChild(a)
                                            }));
                                            var c = o.querySelector("table");
                                            for (c.style.background = "#212F3F", c.style.borderRadius = "4px", c.style.color = "white", c.style.padding = "8px", c.style.display = "block"; c.firstChild;) c.firstChild.remove();
                                            c.appendChild(s), c.appendChild(d)
                                        }
                                        var p = e.canvas,
                                            h = p.offsetLeft,
                                            y = p.offsetTop;
                                        o.style.opacity = 1, o.style.left = h + a.caretX + "px", o.style.top = y + a.caretY + "px", o.style.font = a.options.bodyFont.string
                                    } else o.style.opacity = 0
                                }
                            }
                        },
                        interaction: {
                            intersect: !1
                        },
                        scales: {
                            x: {
                                border: {
                                    display: !1
                                },
                                grid: {
                                    display: !1
                                },
                                ticks: {
                                    color: "white",
                                    font: {
                                        size: 10,
                                        family: "Inter",
                                        weight: "400"
                                    },
                                    callback: function(t) {
                                        return 30 == t || 0 == t || 6 == t || 12 == t || 18 == t || 24 == t ? (label = this.getLabelForValue(t).split("/"), label.pop(), label.join("/")) : ""
                                    }
                                },
                                padding: 10
                            },
                            y: {
                                border: {
                                    display: !1,
                                    dash: [10, 10]
                                },
                                grid: {
                                    color: "rgba(255, 255, 255, 0.1)"
                                },
                                ticks: {
                                    beginAtZero: !0,
                                    color: "white",
                                    font: {
                                        size: 10,
                                        family: "Inter",
                                        weight: "400"
                                    },
                                    padding: 10
                                }
                            }
                        }
                    }
                })
            }
        }, {
            key: "initData",
            value: function(t) {
                this.data = t, this.dataKey = this.data.map((function(t) {
                    return t.key
                })), this.dataValue = this.data.map((function(t) {
                    return t.value
                }))
            }
        }]) && t(a.prototype, o), i && t(a, i), Object.defineProperty(a, "prototype", {
            writable: !1
        }), e
    }();
    $(document).ready((function() {
        window.ChartJobOpportunityGrowthDashboard = new e, setTimeout((function() {
            window.ChartJobOpportunityGrowthDashboard.init([])
        }), 100)
    }))
})();