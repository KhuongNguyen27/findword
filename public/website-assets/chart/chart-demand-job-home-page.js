(() => {
    function t(t, e) {
        var o = Object.keys(t);
        if (Object.getOwnPropertySymbols) {
            var r = Object.getOwnPropertySymbols(t);
            e && (r = r.filter((function(e) {
                return Object.getOwnPropertyDescriptor(t, e).enumerable
            }))), o.push.apply(o, r)
        }
        return o
    }

    function e(e) {
        for (var r = 1; r < arguments.length; r++) {
            var a = null != arguments[r] ? arguments[r] : {};
            r % 2 ? t(Object(a), !0).forEach((function(t) {
                o(e, t, a[t])
            })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(a)) : t(Object(a)).forEach((function(t) {
                Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(a, t))
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

    function r(t, e) {
        for (var o = 0; o < e.length; o++) {
            var r = e[o];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
        }
    }
    var a = function() {
        function t() {
            ! function(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.data = null, this.ctx = null, this.myChart = null, this.htmlLegendPlugin = null, this.libColor = [], this.dataKey = [], this.dataValue = [], this.dataBackgroundColor = [], this.dataBorderColor = []
        }
        var o, a, n;
        return o = t, (a = [{
            key: "init",
            value: function(t) {
                this.initCtx(), this.initLibColor(), this.initData(t), this.initHtmlLegendPlugin(), this.initMyChart()
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
                this.ctx = document.getElementById("myChartDemandJobHomePage").getContext("2d")
            }
        }, {
            key: "initMyChart",
            value: function() {
                var t = this;
                requestAnimationFrame((function() {
                    t.myChart = new Chart(t.ctx, {
                        type: "bar",
                        data: {
                            labels: t.dataKey,
                            datasets: [{
                                data: t.dataValue,
                                backgroundColor: t.dataBackgroundColor,
                                borderColor: t.dataBorderColor,
                                borderWidth: {
                                    top: 5
                                }
                            }],
                            dataRoot: t.data
                        },
                        options: {
                            responsive: !0,
                            maintainAspectRatio: !1,
                            plugins: {
                                htmlLegendDemandJobHomePage: {
                                    containerID: "htmlLegendDemandJobHomePage"
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
                                            r = e.canvas.parentNode.querySelector("div");
                                        if (!r) {
                                            (r = document.createElement("div")).style.opacity = 1, r.style.pointerEvents = "none", r.style.position = "absolute", r.style.transform = "translate(-50%, 0)", r.style.transition = "all .3s ease";
                                            var a = document.createElement("div");
                                            a.classList.add("chartjs-tooltip-caret"), a.style.width = "0", a.style.height = "0", a.style.borderBottomWidth = "".concat(o.options.caretSize, "px"), a.style.borderBottomStyle = "solid", a.style.borderBottomColor = "#212F3F", a.style.borderRightWidth = "".concat(o.options.caretSize, "px"), a.style.borderRightStyle = "solid", a.style.borderRightColor = "transparent", a.style.borderLeftWidth = "".concat(o.options.caretSize, "px"), a.style.borderLeftStyle = "solid", a.style.borderLeftColor = "transparent", a.style.margin = "0 auto", r.appendChild(a);
                                            var n = document.createElement("table");
                                            n.style.margin = "0px", r.appendChild(n), e.canvas.parentNode.appendChild(r)
                                        }
                                        if (0 !== o.opacity) {
                                            if (o.body) {
                                                var i = o.title || [],
                                                    l = o.body.map((function(t) {
                                                        return t.lines
                                                    })),
                                                    d = document.createElement("thead");
                                                d.style.marginBottom = "3px", d.style.display = "block", i.forEach((function(t) {
                                                    var e = document.createElement("tr");
                                                    e.style.borderWidth = 0;
                                                    var o = document.createElement("td");
                                                    o.style.borderWidth = 0, o.style.fontWeight = 400, o.style.fontSize = "12px";
                                                    var r = document.createTextNode(t);
                                                    o.appendChild(r), e.appendChild(o), d.appendChild(e)
                                                }));
                                                var s = document.createElement("tbody");
                                                l.forEach((function(t, e) {
                                                    var o = document.createElement("tr");
                                                    o.style.backgroundColor = "inherit", o.style.borderWidth = 0;
                                                    var r = document.createElement("td");
                                                    r.style.borderWidth = 0, r.style.fontWeight = "bold", r.style.fontSize = "15px", t = t.toLocaleString("en-US", {
                                                        minimumFractionDigits: 3
                                                    }).replace(/,/g, ".");
                                                    var a = document.createTextNode(t);
                                                    r.appendChild(a), o.appendChild(r), s.appendChild(o)
                                                }));
                                                var c = r.querySelector("table");
                                                for (c.style.background = "#212F3F", c.style.borderRadius = "4px", c.style.color = "white", c.style.padding = "8px", c.style.display = "block"; c.firstChild;) c.firstChild.remove();
                                                c.appendChild(d), c.appendChild(s)
                                            }
                                            var u = e.canvas,
                                                p = u.offsetLeft,
                                                h = u.offsetTop;
                                            r.style.opacity = 1, r.style.left = p + o.caretX + "px", r.style.top = h + o.caretY + "px", r.style.font = o.options.bodyFont.string
                                        } else r.style.opacity = 0
                                    }
                                }
                            },
                            interaction: {
                                intersect: !1
                            },
                            scales: {
                                y: {
                                    display: !1,
                                    gridLines: {
                                        display: !1
                                    }
                                },
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
                                            size: 12,
                                            weight: "400",
                                            family: "Inter"
                                        },
                                        callback: function(t, e, o) {
                                            var r = this.chart.data.dataRoot[t].value;
                                            return r = r.toString().replace(/(\d)(?=(\d{3})+$)/g, "$1.")
                                        }
                                    }
                                }
                            }
                        },
                        plugins: [t.htmlLegendPlugin]
                    })
                }))
            }
        }, {
            key: "initHtmlLegendPlugin",
            value: function() {
                this.htmlLegendPlugin = {
                    id: "htmlLegendDemandJobHomePage",
                    afterUpdate: function(t, e, o) {
                        for (var r = document.getElementById(o.containerID); r.firstChild;) r.firstChild.remove();
                        var a = t.data.dataRoot;
                        for (var n in t.data.dataRoot) {
                            var i = document.createElement("div");
                            i.classList.add("item");
                            var l = document.createElement("div");
                            l.classList.add("color"), l.style.background = a[n].borderColor;
                            var d = document.createElement("div");
                            d.classList.add("text"), d.appendChild(document.createTextNode(a[n].key)), i.appendChild(l), i.appendChild(d), r.appendChild(i)
                        }
                        var s = document.createElement("div");
                        s.style.clear = "both", r.appendChild(s)
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
                    o = this.ctx.createLinearGradient(0, 0, 0, document.getElementById("myChartDemandJobHomePage").height);
                return o.addColorStop(.301, e.color.from), o.addColorStop(.9943, e.color.to), {
                    color: o,
                    borderColor: e.borderColor
                }
            }
        }, {
            key: "initData",
            value: function(t) {
                var o = this;
                this.data = t, this.data.forEach((function(t, r) {
                    o.data[r] = e(e({}, o.data[r]), o.getColorInLib(r))
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
        }]) && r(o.prototype, a), n && r(o, n), Object.defineProperty(o, "prototype", {
            writable: !1
        }), t
    }();
    $(document).ready((function() {
        window.ChartDemandJobHomePage = new a
    }))
})();