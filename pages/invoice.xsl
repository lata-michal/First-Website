<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template name="sum-items">
        <xsl:param name="nodes" select="/invoice/items/item"/>
        <xsl:param name="acc" select="0"/>
        <xsl:choose>
            <xsl:when test="count($nodes) = 0">
                <xsl:value-of select="$acc"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:variable name="line_total" select="number($nodes[1]/quantity) * number($nodes[1]/price)"/>
                <xsl:call-template name="sum-items">
                    <xsl:with-param name="nodes" select="$nodes[position()>1]"/>
                    <xsl:with-param name="acc" select="$acc + $line_total"/>
                </xsl:call-template>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="/">
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        margin: 0;
                        padding: 0;
                        display: flex;
                        justify-content: center;
                        align-items: flex-start;
                        min-height: 100vh;
                        background-color: #E9EBDC;
                    }
                    .invoice-container {
                        width: 800px; 
                        height: 600px; 
                        position: relative;
                        background: url('../blankiet.jpg') no-repeat center top;
                        background-size: contain; 
                        margin: 0;
                        padding: 0; 
                    }
                    .date-day {
                        position: absolute;
                        top: 30px; 
                        left: 605px;
                        padding: 0;
                        letter-spacing: 8px;
                        font-size: 18px;
                    }
                    .date-month {
                         position: absolute;
                        top: 30px; 
                        left: 645px; 
                        padding: 0;
                        letter-spacing: 8px;
                        font-size: 18px;
                    }
                    .date-year {
                        position: absolute;
                        top: 30px; 
                        left: 715px; 
                        padding: 0;
                        letter-spacing: 8px;
                        font-size: 18px;
                    }
                    .invoice-number {
                        position: absolute;
                        top: 60px; 
                        left: 480px; 
                        padding: 0;
                        letter-spacing: 2px;
                        font-size: 20px;
                    }
                    .client-name {
                        position: absolute;
                        top: 110px;
                        left: 200px;
                        padding: 0;
                    }
                    .client-address {
                        position: absolute;
                        top: 135px; 
                        left: 120px;
                        padding: 0;
                    }
                    .items {
                        position: absolute;
                        top: 220px; 
                        left: 0px;
                        width: 720px; 
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    td {
                        border: none; 
                        padding: 1px;
                        text-align: center; 
                        vertical-align: middle;
                    }
                    .total {
                        position: absolute;
                        top: 87px; 
                        left: 680px;
                        font-weight: bold;
                        font-size: 16px;
                        text-align: right; 
                    }
                </style>
            </head>
            <body>
                <div class="invoice-container">
                    <div class="date-day">
                       <p><xsl:value-of select="/invoice/details/dateday"/></p>
                    </div>
                    <div class="date-month">
                       <p><xsl:value-of select="/invoice/details/datemonth"/></p>
                    </div>
                    <div class="date-year">
                       <p><xsl:value-of select="/invoice/details/dateyear"/></p>
                    </div>
                    <div class="invoice-number">
                        <p><xsl:value-of select="/invoice/details/number" /></p>
                    </div>
                    <div class="client-name">
                        <p><xsl:value-of select="/invoice/details/client" /></p>
                    </div>
                    <div class="client-address">
                        <p><xsl:value-of select="/invoice/details/address" /></p>
                    </div>

                    <div class="items">
                        <table>
                            <xsl:for-each select="/invoice/items/item">
                                <tr>
                                    <td style="width: 70%"><xsl:value-of select="name" /></td>
                                    <td style="width: 10%"><xsl:value-of select="quantity" /></td>
                                    <td style="width: 10%"><xsl:value-of select="price" /></td>
                                    <td style="width: 10%"><xsl:value-of select="number(quantity)*number(price)" /></td>
                                </tr>
                            </xsl:for-each>
                        </table>
                        <div class ="total">
                                <xsl:call-template name="sum-items">
                                    <xsl:with-param name="nodes" select="/invoice/items/item"/>
                            </xsl:call-template>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
