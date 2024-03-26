(() => {
    function t(t, e) {
        var o = Object.keys(t);
        if (Object.getOwnPropertySymbols) {
            var a = Object.getOwnPropertySymbols(t);
            e && (a = a.filter((function(e) {
                return Object.getOwnPropertyDescriptor(t, e).enumerable
            }))), o.push.apply(o, a)
        }
        return o
    }

    function e(e) {
        for (var a = 1; a < arguments.length; a++) {
            var r = null != arguments[a] ? arguments[a] : {};
            a % 2 ? t(Object(r), !0).forEach((function(t) {
                o(e, t, r[t])
            })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(r)) : t(Object(r)).forEach((function(t) {
                Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(r, t))
            }))
        }
        return e
    }

    function o(t, e, o) {
        return e in t ? Object.defineProperty(t, e, {
            value: o,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : t[e] = o, t
    }

    function a(t, e) {
        for (var o = 0; o < e.length; o++) {
            var a = e[o];
            a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(t, a.key, a)
        }
    }
    var r = function() {
        function t() {
            ! function(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.data = null, this.ctx = null, this.myChart = null, this.htmlLegendPlugin = null, this.libColor = [], this.dataKey = [], this.dataValue = [], this.dataBackgroundColor = [], this.dataBorderColor = []
        }
        var o, r, n;
        return o = t, (r = [{
            key: "init",
            value: function(t) {
                var e = this;
                this.initCtx(), this.initLibColor(), this.initData(t), this.initHtmlLegendPlugin(), this.initMyChart(), this.loadChartDemandJobDashboard(), $("#dashboard #demand-job-select-dashboard").change((function() {
                    e.loadChartDemandJobDashboard()
                }))
            }
        }, {
            key: "loadChartDemandJobDashboard",
            value: function() {
                $.ajax({
                    url: app.home.recruitmentDemand,
                    data: {
                        type: $("#dashboard #demand-job-select-dashboard").val()
                    },
                    type: "get",
                    success: function(t) {
                        "success" == t.status ? ($("#dashboard-section .block-chart .loading-chart").css("display", "none"), $("#dashboard-section .block-chart .box-chart").css("display", "block"), setTimeout((function() {
                            window.ChartDemandJobDashboard.update(t.data)
                        }), 100)) : console.log("failed!")
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
                        backgroundColor: this.dataBackgroundColor,
                        borderColor: this.dataBorderColor,
                        borderWidth: {
                            top: 5
                        }
                    }],
                    dataRoot: this.data
                }, this.myChart.update()
            }
        }, {
            key: "initCtx",
            value: function() {
                this.ctx = document.getElementById("myChartDemandJobDashboard").getContext("2d")
            }
        }, {
            key: "initMyChart",
            value: function() {
                this.myChart = new Chart(this.ctx, {
                    type: "bar",
                    data: {
                        labels: this.dataKey,
                        datasets: [{
                            data: this.dataValue,
                            backgroundColor: this.dataBackgroundColor,
                            borderColor: this.dataBorderColor,
                            borderWidth: {
                                top: 5
                            }
                        }],
                        dataRoot: this.data
                    },
                    options: {
                        responsive: !0,
                        maintainAspectRatio: !1,
                        plugins: {
                            htmlLegendDemandJobDashboard: {
                                containerID: "htmlLegendDemandJobDashboard"
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
                                        o = t.tooltip,
                                        a = e.canvas.parentNode.querySelector("div");
                                    if (!a) {
                                        (a = document.createElement("div")).style.opacity = 1, a.style.pointerEvents = "none", a.style.position = "absolute", a.style.transform = "translate(-50%, 0)", a.style.transition = "all .3s ease";
                                        var r = document.createElement("div");
                                        r.classList.add("chartjs-tooltip-caret"), r.style.width = "0", r.style.height = "0", r.style.borderBottomWidth = "".concat(o.options.caretSize, "px"), r.style.borderBottomStyle = "solid", r.style.borderBottomColor = "#212F3F", r.style.borderRightWidth = "".concat(o.options.caretSize, "px"), r.style.borderRightStyle = "solid", r.style.borderRightColor = "transparent", r.style.borderLeftWidth = "".concat(o.options.caretSize, "px"), r.style.borderLeftStyle = "solid", r.style.borderLeftColor = "transparent", r.style.margin = "0 auto", a.appendChild(r);
                                        var n = document.createElement("table");
                                        n.style.margin = "0px", a.appendChild(n), e.canvas.parentNode.appendChild(a)
                                    }
                                    if (0 !== o.opacity) {
                                        if (o.body) {
                                            var i = o.title || [],
                                                d = o.body.map((function(t) {
                                                    return t.lines
                                                })),
                                                l = document.createElement("thead");
                                            l.style.marginBottom = "3px", l.style.display = "block", i.forEach((function(t) {
                                                var e = document.createElement("tr");
                                                e.style.borderWidth = 0;
                                                var o = document.createElement("td");
                                                o.style.borderWidth = 0, o.style.fontWeight = 400, o.style.fontSize = "12px";
                                                var a = document.createTextNode(t);
                                                o.appendChild(a), e.appendChild(o), l.appendChild(e)
                                            }));
                                            var s = document.createElement("tbody");
                                            d.forEach((function(t, e) {
                                                var o = document.createElement("tr");
                                                o.style.backgroundColor = "inherit", o.style.borderWidth = 0;
                                                var a = document.createElement("td");
                                                a.style.borderWidth = 0, a.style.fontWeight = "bold", a.style.fontSize = "15px", t = t.toLocaleString("en-US", {
                                                    minimumFractionDigits: 3
                                                }).replace(/,/g, ".");
                                                var r = document.createTextNode(t + " việc làm");
                                                a.appendChild(r), o.appendChild(a), s.appendChild(o)
                                            }));
                                            var c = a.querySelector("table");
                                            for (c.style.background = "#212F3F", c.style.borderRadius = "4px", c.style.color = "white", c.style.padding = "8px", c.style.display = "block"; c.firstChild;) c.firstChild.remove();
                                            c.appendChild(l), c.appendChild(s)
                                        }
                                        var h = e.canvas,
                                            b = h.offsetLeft,
                                            u = h.offsetTop;
                                        a.style.opacity = 1, a.style.left = b + o.caretX + "px", a.style.top = u + o.caretY + "px", a.style.font = o.options.bodyFont.string
                                    } else a.style.opacity = 0
                                }
                            }
                        },
                        interaction: {
                            intersect: !1
                        },
                        scales: {
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
                                    padding: 5,
                                    stepSize: 200
                                }
                            },
                            x: {
                                display: !1
                            }
                        }
                    },
                    plugins: [this.htmlLegendPlugin]
                })
            }
        }, {
            key: "initHtmlLegendPlugin",
            value: function() {
                this.htmlLegendPlugin = {
                    id: "htmlLegendDemandJobDashboard",
                    afterUpdate: function(t, e, o) {
                        for (var a = document.getElementById(o.containerID); a.firstChild;) a.firstChild.remove();
                        var r = t.data.dataRoot;
                        for (var n in t.data.dataRoot) {
                            var i = document.createElement("div");
                            i.classList.add("item");
                            var d = document.createElement("div");
                            d.classList.add("color"), d.style.background = r[n].borderColor;
                            var l = document.createElement("div");
                            l.classList.add("text"), l.appendChild(document.createTextNode(r[n].key)), i.appendChild(d), i.appendChild(l), a.appendChild(i)
                        }
                        var s = document.createElement("div");
                        s.style.clear = "both", a.appendChild(s)
                    }
                }
            }
        }, {
            key: "initLibColor",
            value: function() {
                this.libColor = [{
                    color: {
                        from: "rgba(26, 191, 99, 0.22)",
                        to: "rgba(0, 177, 79, 0)"
                    },
                    borderColor: "#11D769"
                }, {
                    color: {
                        from: "rgba(48, 138, 255, 0.31)",
                        to: "rgba(48, 138, 255, 0)"
                    },
                    borderColor: "#308AFF"
                }, {
                    color: {
                        from: "rgba(255, 159, 0, 0.29)",
                        to: "rgba(255, 159, 0, 0)"
                    },
                    borderColor: "#DA8300"
                }, {
                    color: {
                        from: "rgba(28, 255, 241, 0.22)",
                        to: "rgba(28, 255, 241, 0)"
                    },
                    borderColor: "#1CFFF1"
                }, {
                    color: {
                        from: "rgba(255, 231, 0, 0.18)",
                        to: "rgba(255, 231, 0, 0)"
                    },
                    borderColor: "#FFE700"
                }, {
                    color: {
                        from: "rgba(255, 255, 255, 0.22)",
                        to: "rgba(255, 255, 255, 0)"
                    },
                    borderColor: "#FFFFFF"
                }]
            }
        }, {
            key: "getColorInLib",
            value: function(t) {
                var e = this.libColor[t],
                    o = this.ctx.createLinearGradient(0, 0, 0, document.getElementById("myChartDemandJobDashboard").height);
                return o.addColorStop(.301, e.color.from), o.addColorStop(.9943, e.color.to), {
                    color: o,
                    borderColor: e.borderColor
                }
            }
        }, {
            key: "initData",
            value: function(t) {
                var o = this;
                this.data = t, this.data.forEach((function(t, a) {
                    o.data[a] = e(e({}, o.data[a]), o.getColorInLib(a))
                })), this.dataKey = this.data.map((function(t) {
                    return t.key
                })), this.dataValue = this.data.map((function(t) {
                    return t.value
                })), this.dataBackgroundColor = this.data.map((function(t) {
                    return t.color
                })), this.dataBorderColor = this.data.map((function(t) {
                    return t.borderColor
                }))
            }
        }]) && a(o.prototype, r), n && a(o, n), Object.defineProperty(o, "prototype", {
            writable: !1
        }), t
    }();
    $(document).ready((function() {
        window.ChartDemandJobDashboard = new r, setTimeout((function() {
            window.ChartDemandJobDashboard.init([])
        }), 100)
    }))
})();