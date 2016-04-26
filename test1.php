<?php


$test_str="
telnet@bbs1000_100.3# show interface epon-olt mac-address-table
Record  OLT   LPort  ONU id  LLID  VID   Mac_Address        Type
-------------------------------------------------------------------
 1      1/1   1      0       0     1     00:07:ba:3a:14:af  Dynamic
 2      1/1   1      0       0     1     34:08:04:d6:80:77  Dynamic
 3      1/1   2      2       2     1     00:07:ba:3a:14:a6  Dynamic
 4      1/1   2      2       2     1     00:1d:7d:d5:36:bc  Dynamic
 5      1/1   3      1       1     1     00:07:ba:3a:14:9e  Dynamic
 6      1/1   3      1       1     1     bc:ae:c5:c4:e6:d7  Dynamic
 7      1/1   5      5       5     1     00:07:ba:3a:19:0a  Dynamic
 8      1/1   5      5       5     1     f8:1a:67:c4:17:2f  Dynamic
 9      1/1   6      9       9     1     00:07:ba:3a:13:55  Dynamic
 10     1/1   6      9       9     1     bc:5f:f4:84:ea:03  Dynamic
 11     1/1   7      4       4     1     00:07:ba:3a:13:a6  Dynamic
 12     1/1   7      4       4     1     00:13:77:9b:95:6b  Dynamic
 13     1/1   8      7       7     1     00:07:ba:3a:13:54  Dynamic
 14     1/1   8      7       7     1     28:10:7b:f0:00:b7  Dynamic
 15     1/1   11     11      11    1     00:07:ba:3a:17:43  Dynamic
 16     1/1   11     11      11    1     10:fe:ed:99:cc:5f  Dynamic
 17     1/1   16     10      10    1     00:07:ba:3a:15:1f  Dynamic
 18     1/1   16     10      10    1     f4:6d:04:77:9a:a6  Dynamic
 19     1/1   18     12      12    1     00:11:2f:97:4c:1f  Dynamic
 20     1/1   18     12      12    1     a0:c6:ec:03:9d:8e  Dynamic
 21     1/1   19     13      13    1     00:02:44:af:ff:d4  Dynamic
 22     1/1   19     13      13    1     00:d0:d0:36:63:55  Dynamic
 23     1/2   1      4       4     1     00:07:ba:3a:15:19  Dynamic
 24     1/2   1      4       4     1     60:eb:69:c4:95:55  Dynamic
 25     1/2   2      2       2     1     00:07:ba:3a:16:6a  Dynamic
 26     1/2   2      2       2     1     f4:ec:38:9f:4a:e3  Dynamic
 27     1/2   3      7       7     1     00:07:ba:3a:17:f4  Dynamic
 28     1/2   4      6       6     1     00:07:ba:3a:14:b0  Dynamic
 29     1/2   4      6       6     1     00:1e:8c:30:1e:b1  Dynamic
 30     1/2   5      18      18    1     50:46:5d:62:62:a0  Dynamic
 31     1/2   6      9       9     1     00:1d:2b:fd:90:e0  Dynamic
 32     1/2   6      9       9     1     50:46:5d:a1:04:93  Dynamic
 33     1/2   7      1       1     1     00:07:ba:3a:14:70  Dynamic
 34     1/2   7      1       1     1     a0:b3:cc:6c:68:27  Dynamic
 35     1/2   9      0       0     1     00:07:ba:3a:14:ad  Dynamic
 36     1/2   9      0       0     1     00:e0:4b:00:5f:f4  Dynamic
 37     1/2   10     8       8     1     00:07:ba:3a:17:e6  Dynamic
 38     1/2   10     8       8     1     f8:1a:67:8e:25:df  Dynamic
 39     1/2   11     11      11    1     00:07:ba:3a:14:a3  Dynamic
 40     1/2   11     11      11    1     f0:de:f1:fc:9d:0f  Dynamic
 41     1/2   12     30      30    1     00:07:ba:3a:16:10  Dynamic
 42     1/2   12     30      30    1     00:19:db:3f:c1:5e  Dynamic
 43     1/2   13     25      25    1     20:6a:8a:78:27:4f  Dynamic
 44     1/2   13     25      25    1     fc:fa:f7:c5:2b:40  Dynamic
 45     1/2   14     13      13    1     00:1a:4d:9c:b9:5b  Dynamic
 46     1/2   14     13      13    1     fc:fa:f7:c5:72:84  Dynamic
 47     1/2   15     21      21    1     00:07:ba:3a:13:82  Dynamic
 48     1/2   15     21      21    1     f8:d1:11:4d:3f:b3  Dynamic
 49     1/2   16     16      16    1     00:07:ba:3a:13:44  Dynamic
 50     1/2   16     16      16    1     bc:ae:c5:ea:e9:2d  Dynamic
 51     1/2   17     20      20    1     00:07:ba:3a:13:51  Dynamic
 52     1/2   17     20      20    1     64:70:02:4c:ec:5d  Dynamic
 53     1/2   18     22      22    1     a0:c6:ec:01:2c:18  Dynamic
 54     1/2   18     22      22    1     c4:6e:1f:65:d9:af  Dynamic
 55     1/2   19     28      28    1     64:66:b3:12:13:0d  Dynamic
 56     1/2   19     28      28    1     fc:fa:f7:c5:d6:24  Dynamic
 57     1/2   23     26      26    1     6c:62:6d:44:08:11  Dynamic
 58     1/2   23     26      26    1     fc:fa:f7:c5:f7:87  Dynamic
 59     1/2   24     3       3     1     00:07:ba:3a:14:04  Dynamic
 60     1/2   24     3       3     1     94:44:52:55:fa:ff  Dynamic
 61     1/2   25     19      19    1     00:07:ba:3a:14:44  Dynamic
 62     1/2   25     19      19    1     08:60:6e:88:12:f3  Dynamic
 63     1/2   26     27      27    1     00:07:ba:3a:13:53  Dynamic
 64     1/2   26     27      27    1     b8:70:f4:2b:00:75  Dynamic
 65     1/2   28     17      17    1     00:07:ba:3a:16:63  Dynamic
 66     1/2   28     17      17    1     00:13:8f:99:7b:1a  Dynamic
 67     1/2   29     15      15    100   80:14:a8:05:c2:d8  Dynamic
 68     1/2   29     15      15    1     00:1f:c6:58:09:a6  Dynamic
 69     1/2   29     15      15    1     80:14:a8:05:c2:d8  Dynamic
 70     1/2   30     10      10    100   80:14:a8:0a:47:a8  Dynamic
 71     1/2   30     10      10    1     80:14:a8:0a:47:a8  Dynamic
 72     1/2   31     5       5     1     00:07:ba:3a:16:a1  Dynamic
 73     1/2   31     5       5     1     00:1e:8c:30:04:f6  Dynamic
 74     1/2   32     23      23    1     3c:46:d8:10:18:17  Dynamic
 75     1/2   32     23      23    1     d4:3d:7e:4b:14:de  Dynamic
 76     1/2   35     24      24    1     08:10:76:43:90:50  Dynamic
 77     1/2   35     24      24    1     e0:67:b3:09:65:38  Dynamic
 78     1/2   36     14      14    1     00:0d:61:a5:c2:bd  Dynamic
 79     1/2   36     14      14    1     00:1f:a4:fe:bc:38  Dynamic
 80     1/3   1      10      10    1     00:07:ba:3a:17:8d  Dynamic
 81     1/3   1      10      10    1     e8:11:32:d6:8a:ea  Dynamic
 82     1/3   2      11      11    100   80:14:a8:05:c2:a8  Dynamic
 83     1/3   2      11      11    1     00:1a:92:56:b9:c0  Dynamic
 84     1/3   2      11      11    1     80:14:a8:05:c2:a8  Dynamic
 85     1/3   3      12      12    1     00:1d:2b:fd:90:a0  Dynamic
 86     1/3   3      12      12    1     40:61:86:c4:12:d4  Dynamic
 87     1/3   4      13      13    1     00:1d:2b:fd:90:d8  Dynamic
 88     1/3   4      13      13    1     00:26:9e:f3:4f:c9  Dynamic
 89     1/3   5      15      15    1     3c:46:d8:10:17:ef  Dynamic
 90     1/3   5      15      15    1     a0:f3:c1:3b:67:2d  Dynamic
 91     1/3   6      14      14    1     08:57:00:fe:8d:b2  Dynamic
 92     1/3   6      14      14    1     48:5b:39:06:60:d0  Dynamic
 93     1/3   7      17      17    102   00:24:54:cf:a5:a6  Dynamic
 94     1/3   7      17      17    1     c0:7e:40:59:0a:3f  Dynamic
 95     1/3   8      8       8     1     00:24:54:dc:3d:bd  Dynamic
 96     1/3   8      8       8     1     00:d0:d0:48:c0:6f  Dynamic
 97     1/3   9      6       6     1     00:19:c6:f6:79:12  Dynamic
 98     1/3   9      6       6     1     00:e0:4d:0c:39:d6  Dynamic
 99     1/3   10     4       4     1     00:80:48:ea:de:ff  Dynamic
 100    1/3   10     4       4     1     00:d0:d0:53:3d:62  Dynamic
 101    1/3   11     2       2     1     00:08:81:3a:64:6e  Dynamic
 102    1/3   11     2       2     1     00:d0:d0:42:2d:18  Dynamic
 103    1/3   12     16      16    1     c0:7e:40:59:0a:f4  Dynamic
 104    1/3   12     16      16    1     f8:1a:67:e4:b8:47  Dynamic
 105    1/3   13     9       9     1     90:2b:34:e7:ee:00  Dynamic
 106    1/3   13     9       9     1     c0:7e:40:58:1b:1e  Dynamic
 107    1/3   14     5       5     1     c0:7e:40:58:1b:19  Dynamic
 108    1/3   15     3       3     1     10:fe:ed:61:bb:55  Dynamic
 109    1/3   15     3       3     1     c0:7e:40:58:1b:18  Dynamic
 110    1/3   16     0       0     1     c0:7e:40:58:1b:25  Dynamic
 111    1/3   17     1       1     1     20:cf:30:de:76:3b  Dynamic
 112    1/3   17     1       1     1     c0:7e:40:58:1b:23  Dynamic
 113    1/4   1      5       5     1     00:1b:38:b0:f1:c4  Dynamic
 114    1/4   1      5       5     1     c0:7e:40:58:1b:1a  Dynamic
 115    1/4   2      7       7     1     8c:89:a5:6a:67:1a  Dynamic
 116    1/4   2      7       7     1     c0:7e:40:58:1b:16  Dynamic
 117    1/4   3      3       3     1     00:07:ba:3a:16:76  Dynamic
 118    1/4   3      3       3     1     84:c9:b2:ab:10:27  Dynamic
 119    1/4   4      1       1     1     00:02:44:72:d4:4d  Dynamic
 120    1/4   4      1       1     1     00:18:f3:f2:e3:61  Dynamic
 121    1/4   4      1       1     1     00:24:1d:84:39:2e  Dynamic
 122    1/4   4      1       1     1     00:30:05:4f:de:f1  Dynamic
 123    1/4   4      1       1     1     3c:d9:2b:22:6e:5d  Dynamic
 124    1/4   4      1       1     1     a0:f3:c1:4c:ba:73  Dynamic
 125    1/4   4      1       1     1     f8:1a:67:e4:b6:b5  Dynamic
 126    1/4   4      1       1     1     fc:fa:f7:c5:72:8c  Dynamic
 127    1/4   5      9       9     1     00:1b:fc:ed:36:2b  Dynamic
 128    1/4   5      9       9     1     c0:7e:40:59:0a:43  Dynamic
 129    1/4   5      9       9     1     f8:d1:11:50:b8:87  Dynamic
 130    1/4   7      6       6     1     4c:b1:99:eb:3c:fa  Dynamic
 131    1/4   7      6       6     1     c0:7e:40:58:1b:1b  Dynamic
 132    1/4   8      4       4     1     b8:88:e3:5f:dc:9b  Dynamic
 133    1/4   8      4       4     1     c0:7e:40:58:22:1f  Dynamic
 134    1/4   9      0       0     1     74:d0:2b:ad:61:43  Dynamic
 135    1/4   9      0       0     1     c0:7e:40:58:22:2c  Dynamic
 136    1/4   10     8       8     1     60:a4:4c:8b:cf:e8  Dynamic
 137    1/4   10     8       8     1     a0:c6:ec:01:2e:74  Dynamic
 138    2/1   1      0       0     1     00:07:ba:3a:17:8e  Dynamic
 139    2/1   1      0       0     1     bc:ae:c5:85:41:e1  Dynamic
 140    2/1   4      1       1     1     00:1d:2b:fd:90:e8  Dynamic
 141    2/1   4      1       1     1     10:fe:ed:fc:79:ad  Dynamic
 142    2/1   5      11      11    1     00:07:ba:3a:17:95  Dynamic
 143    2/1   5      11      11    1     c0:4a:00:7c:8b:c5  Dynamic
 144    2/1   7      14      14    102   24:a4:3c:fa:a6:3d  Dynamic
 145    2/1   7      14      14    1     a0:c6:ec:01:2f:b2  Dynamic
 146    2/1   8      9       9     1     00:07:ba:3a:14:4b  Dynamic
 147    2/1   8      9       9     1     38:ea:a7:ea:ba:56  Dynamic
 148    2/1   9      4       4     1     00:07:ba:3a:17:fe  Dynamic
 149    2/1   9      4       4     1     00:25:22:3f:2b:8b  Dynamic
 150    2/1   10     5       5     1     00:07:ba:3a:17:96  Dynamic
 151    2/1   10     5       5     1     54:04:a6:bf:e8:f0  Dynamic
 152    2/1   12     6       6     1     00:07:ba:3a:16:6b  Dynamic
 153    2/1   12     6       6     1     00:22:15:e0:86:cd  Dynamic
 154    2/1   13     12      12    1     a0:c6:ec:01:2f:16  Dynamic
 155    2/1   13     12      12    1     c8:3a:35:15:90:f8  Dynamic
 156    2/1   14     8       8     1     00:07:ba:3a:17:46  Dynamic
 157    2/1   14     8       8     1     a0:f3:c1:cd:95:b7  Dynamic
 158    2/1   18     16      16    1     66:60:ce:8f:13:00  Dynamic
 159    2/1   18     16      16    1     c8:3a:35:b1:f6:ef  Dynamic
 160    2/1   20     3       3     102   e0:cb:4e:e6:70:61  Dynamic
 161    2/1   20     3       3     1     00:0d:87:55:27:b4  Dynamic
 162    2/1   20     3       3     1     00:19:66:f8:09:87  Dynamic
 163    2/1   20     3       3     1     00:1d:7d:a0:78:06  Dynamic
 164    2/1   20     3       3     1     00:26:5a:13:4c:ef  Dynamic
 165    2/1   20     3       3     1     08:18:1a:fd:f6:42  Dynamic
 166    2/1   20     3       3     1     30:b5:c2:5d:86:33  Dynamic
 167    2/1   20     3       3     1     48:5b:39:ab:8e:15  Dynamic
 168    2/1   20     3       3     1     6c:71:d9:57:fb:71  Dynamic
 169    2/1   20     3       3     1     ac:b5:7d:3a:ff:77  Dynamic
 170    2/1   20     3       3     1     b8:a3:86:0b:b3:b3  Dynamic
 171    2/1   20     3       3     1     f0:76:1c:32:8f:0d  Dynamic
 172    2/1   21     7       7     1     08:18:1a:ff:5f:12  Dynamic
 173    2/1   21     7       7     1     14:da:e9:9c:aa:28  Dynamic
 174    2/1   21     7       7     1     78:24:af:da:78:86  Dynamic
 175    2/1   21     7       7     1     e8:11:32:cd:ec:1b  Dynamic
 176    2/1   21     7       7     1     f8:1a:67:10:ff:49  Dynamic
 177    2/1   22     13      13    1     10:78:d2:87:2f:31  Dynamic
 178    2/1   22     13      13    1     c0:7e:40:59:0a:ac  Dynamic
 179    2/1   22     13      13    1     d8:50:e6:04:7b:4f  Dynamic
 180    2/1   23     2       2     1     48:5b:39:17:9e:0a  Dynamic
 181    2/1   23     2       2     1     c0:7e:40:58:1b:1f  Dynamic
 182    2/2   1      6       6     1     00:07:ba:3a:17:2d  Dynamic
 183    2/2   1      6       6     1     00:14:85:b2:3a:dc  Dynamic
 184    2/2   2      4       4     1     00:07:ba:3a:18:c5  Dynamic
 185    2/2   3      5       5     1     00:07:ba:3a:17:82  Dynamic
 186    2/2   3      5       5     1     00:1c:c0:35:52:b2  Dynamic
 187    2/2   5      2       2     1     00:07:ba:3a:13:4f  Dynamic
 188    2/2   5      2       2     1     00:10:4b:3d:ee:dc  Dynamic
 189    2/2   6      0       0     1     00:07:ba:3a:14:7c  Dynamic
 190    2/2   6      0       0     1     f8:1a:67:62:9d:c1  Dynamic
 191    2/2   7      8       8     1     00:24:21:e8:c3:53  Dynamic
 192    2/2   7      8       8     1     a0:c6:ec:01:2d:4c  Dynamic
 193    2/2   8      3       3     1     00:07:ba:3a:15:14  Dynamic
 194    2/2   8      3       3     1     fc:8b:97:66:da:1b  Dynamic
 195    2/2   9      1       1     1     00:07:ba:3a:13:87  Dynamic
 196    2/2   9      1       1     1     74:d4:35:e8:c9:81  Dynamic
 197    2/2   10     9       9     1     00:d0:d0:51:9d:d6  Dynamic
 198    2/2   10     9       9     1     14:d6:4d:e8:93:89  Dynamic
 199    2/2   11     7       7     1     00:07:ba:3a:16:c3  Dynamic
 200    2/2   11     7       7     1     e0:cb:4e:e4:9a:ff  Dynamic
 201    2/3   1      2       2     1     00:07:ba:3a:14:9d  Dynamic
 202    2/3   1      2       2     1     00:0d:61:07:da:42  Dynamic
 203    2/3   2      3       3     1     00:07:ba:3a:17:38  Dynamic
 204    2/3   2      3       3     1     a0:f3:c1:7d:0a:85  Dynamic
 205    2/3   3      6       6     1     00:07:ba:3a:14:a2  Dynamic
 206    2/3   3      6       6     1     54:ee:75:01:0d:21  Dynamic
 207    2/3   4      1       1     1     00:07:ba:3a:17:72  Dynamic
 208    2/3   5      5       5     1     00:07:ba:3a:13:96  Dynamic
 209    2/3   5      5       5     1     74:e5:43:38:ff:e9  Dynamic
 210    2/3   7      9       9     1     00:19:db:b7:82:64  Dynamic
 211    2/3   7      9       9     1     a0:c6:ec:01:2f:18  Dynamic
 212    2/3   9      8       8     1     00:07:ba:3a:1a:3c  Dynamic
 213    2/3   9      8       8     1     bc:5f:f4:b9:83:a2  Dynamic
 214    2/3   12     0       0     1     00:1d:92:29:dd:6f  Dynamic
 215    2/3   12     0       0     1     c0:7e:40:58:1b:2a  Dynamic
 216    2/4   1      4       4     1     00:07:ba:3a:1a:29  Dynamic
 217    2/4   2      3       3     1     00:07:ba:3a:1a:2e  Dynamic
 218    2/4   3      29      29    1     00:07:ba:3a:14:59  Dynamic
 219    2/4   3      29      29    1     00:16:17:2c:bc:a0  Dynamic
 220    2/4   6      35      35    1     00:07:ba:3a:18:fd  Dynamic
 221    2/4   7      24      24    1     c0:7e:40:45:1a:5b  Dynamic
 222    2/4   7      24      24    1     e8:94:f6:c1:6b:6b  Dynamic
 223    2/4   9      34      34    1     00:13:8f:da:16:28  Dynamic
 224    2/4   9      34      34    1     fc:fa:f7:c5:fb:bb  Dynamic
 225    2/4   11     32      32    1     04:8d:38:82:6e:ca  Dynamic
 226    2/4   11     32      32    1     c0:7e:40:45:18:1a  Dynamic
 227    2/4   12     30      30    1     00:07:ba:3a:15:18  Dynamic
 228    2/4   14     5       5     1     00:e0:00:00:11:b1  Dynamic
 229    2/4   14     5       5     1     fc:fa:f7:c5:72:8d  Dynamic
 230    2/4   15     7       7     1     00:07:ba:3a:1a:31  Dynamic
 231    2/4   15     7       7     1     00:13:d4:0b:ff:39  Dynamic
 232    2/4   19     45      45    1     00:07:ba:3a:17:18  Dynamic
 233    2/4   19     45      45    1     50:e5:49:d5:4a:a1  Dynamic
 234    2/4   20     2       2     1     c0:4a:00:0d:6b:7b  Dynamic
 235    2/4   21     27      27    1     00:07:ba:3a:18:0a  Dynamic
 236    2/4   21     27      27    1     70:5a:b6:fd:92:4f  Dynamic
 237    2/4   22     44      44    1     00:e0:52:b6:dc:b6  Dynamic
 238    2/4   22     44      44    1     04:8d:38:77:01:0b  Dynamic
 239    2/4   23     14      14    1     00:07:ba:3a:16:d8  Dynamic
 240    2/4   23     14      14    1     00:25:22:ee:84:4c  Dynamic
 241    2/4   24     42      42    1     a0:c6:ec:03:9d:80  Dynamic
 242    2/4   24     42      42    1     e8:94:f6:b7:3a:83  Dynamic
 243    2/4   25     13      13    1     c0:4a:00:9d:e7:31  Dynamic
 244    2/4   25     13      13    1     fc:fa:f7:c5:72:90  Dynamic
 245    2/4   27     10      10    1     00:07:ba:3a:17:0a  Dynamic
 246    2/4   27     10      10    1     b4:b5:2f:77:90:c0  Dynamic
 247    2/4   30     38      38    1     00:18:f3:0f:ab:36  Dynamic
 248    2/4   30     38      38    1     c0:7e:40:45:18:9a  Dynamic
 249    2/4   31     25      25    1     00:07:ba:3a:14:7d  Dynamic
 250    2/4   31     25      25    1     00:1f:c6:4a:93:b4  Dynamic
 251    2/4   32     11      11    1     00:07:ba:3a:16:6f  Dynamic
 252    2/4   32     11      11    1     00:1c:25:74:4c:e4  Dynamic
 253    2/4   33     20      20    1     00:07:ba:3a:15:1a  Dynamic
 254    2/4   33     20      20    1     20:6a:8a:21:49:85  Dynamic
 255    2/4   34     31      31    1     08:57:00:c2:c4:87  Dynamic
 256    2/4   34     31      31    1     3c:97:0e:9a:85:39  Dynamic
 257    2/4   35     40      40    1     00:e0:4d:42:42:88  Dynamic
 258    2/4   35     40      40    1     a0:c6:ec:03:9d:8b  Dynamic
 259    2/4   36     22      22    1     00:07:ba:3a:14:5f  Dynamic
 260    2/4   36     22      22    1     a0:f3:c1:3b:5f:65  Dynamic
 261    2/4   38     37      37    1     00:07:ba:3a:17:13  Dynamic
 262    2/4   38     37      37    1     00:17:31:d8:5f:dc  Dynamic
 263    2/4   39     36      36    1     00:07:ba:3a:1a:3e  Dynamic
 264    2/4   39     36      36    1     10:fe:ed:4a:52:9f  Dynamic
 265    2/4   40     33      33    1     00:07:ba:3a:14:73  Dynamic
 266    2/4   40     33      33    1     e8:94:f6:7b:8b:7f  Dynamic
 267    2/4   41     39      39    1     10:78:d2:dc:78:e1  Dynamic
 268    2/4   41     39      39    1     e0:67:b3:09:65:3e  Dynamic
 269    2/4   42     16      16    1     00:07:ba:3a:17:f1  Dynamic
 270    2/4   42     16      16    1     04:8d:38:4d:30:18  Dynamic
 271    2/4   45     15      15    1     00:07:ba:3a:13:a4  Dynamic
 272    2/4   45     15      15    1     6c:f0:49:df:68:a2  Dynamic
 273    2/4   46     28      28    1     00:07:ba:3a:13:f1  Dynamic
 274    2/4   46     28      28    1     00:0d:61:55:47:4d  Dynamic
 275    2/4   47     23      23    1     00:07:ba:3a:13:ac  Dynamic
 276    2/4   47     23      23    1     10:09:87:00:06:19  Dynamic
 277    2/4   48     1       1     1     00:13:d4:fc:1e:b4  Dynamic
 278    2/4   52     8       8     1     60:eb:69:75:67:7e  Dynamic
 279    2/4   53     18      18    1     00:07:ba:3a:17:29  Dynamic
 280    2/4   53     18      18    1     b8:88:e3:89:89:99  Dynamic
 281    2/4   54     43      43    1     00:d0:d0:51:8b:a8  Dynamic
 282    2/4   54     43      43    1     e8:94:f6:ca:47:b5  Dynamic
 283    2/4   56     19      19    1     00:07:ba:3a:16:68  Dynamic
 284    2/4   58     9       9     1     00:07:ba:3a:18:0c  Dynamic
 285    2/4   58     9       9     1     00:e0:51:36:02:6c  Dynamic
 286    2/4   61     46      46    1     08:18:1a:ff:84:82  Dynamic
 287    2/4   62     12      12    102   ec:43:f6:02:11:b5  Dynamic
 288    2/4   62     12      12    1     00:d0:d0:51:d7:04  Dynamic
 289    2/4   62     12      12    1     ec:43:f6:02:11:b5  Dynamic
telnet@bbs1000_100.3#
";
$read_continiue=$test_str;
$read_continiue=str_replace('Press any key to continue (Q to quit)',"",$read_continiue);
$read_continiue=str_replace("\n","<br>",$read_continiue);
 preg_match_all('#(<br> )(.*?)(Dynamic)#isu', $read_continiue, $arr);
        $i=0;
        $count = count($arr[0]);
        echo "var mac_array=[";
        while ($i < $count)    {
                #$onunum = preg_replace("/\"\r\n]+/i", "", $arr2[4]);
                $str=$arr[0][$i];
                #$del_prob=str_replace("  ","",$str);
                $del_prob = explode("  ", $str);
                $str1=substr($str,59-14,17);
                echo "'".$str1."'";
                if ($i+1 < $count){ print ", "; } else {print '];'; }
                $i++;
        }

