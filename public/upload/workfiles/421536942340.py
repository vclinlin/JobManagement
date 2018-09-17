# 第2题
def fun2():
    result = []
    for x in range(1, 5): 
        for y in range(1, 5):
            for z in range(1, 5):
                if x != y and x != z  and y != z: 
                    num = str(x) + str(y) + str(z) 
                    result.append(num) 

   

# 第3题
def fun3():
   
    jiangjin = 0
    if i <= 100000:
        jiangjin += 100000 * 0.1
    elif i > 100000 and i <= 200000:
        jiangjin += 100000 * 0.1
        jiangjin += (i - 100000) * 0.075
    elif i > 200000 and i <= 400000:
        jiangjin += 100000 * 0.1
        jiangjin += 100000 * 0.075
        jiangjin += (i - 200000) * 0.05
    
    elif i > 1000000:
        iangjin += 100000 * 0.1
        jiangjin += 100000 * 0.075
        jiangjin += 200000 * 0.05
        jiangjin += 200000 * 0.03
        jiangjin += 400000 * 0.015
        jiangjin += (i - 1000000) * 0.01

    print('您的奖金是:' + str(jiangjin))

# 第4题
def fun4():
   
    result = []
    for num in range(1, 10000):
        x = int((num + 100) ** 0.5) # number ** 0.5 开平方
        y = int((num + 268) ** 0.5)
        if (x * x == num + 100) and (y * y == num + 268):
            result.append(num)

 
    print(result)



