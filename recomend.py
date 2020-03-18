# -*- coding: utf-8 -*-
import sys
from math import sqrt
from ast import literal_eval


# critics = sys.argv[1]



critics = {
    '차현석': {
        '택시운전사': 2.5,
        '남한산성': 3.5,
        '킹스맨:골든서클': 3.0,
        '범죄도시': 3.5,
        '아이 캔 스피크': 2.5,
        'The Night Listener': 3.0
    },
    '황해도': {
        '택시운전사': 1.0,
        '남한산성': 4.5,
        '킹스맨:골든서클': 0.5,
        '범죄도시': 1.5,
        '아이 캔 스피크': 4.5,
        'The Night Listener': 5.0
    },
    '김미희': {
        '택시운전사': 3.0,
        '남한산성': 3.5,
        '킹스맨:골든서클': 1.5,
        '범죄도시': 5.0,
        'The Night Listener': 3.0,
        '아이 캔 스피크': 3.5
    },
    '김준형': {
        '택시운전사': 2.5,
        '남한산성': 3.0,
        '범죄도시': 3.5,
        'The Night Listener': 4.0
    },
    '이은비': {
        '남한산성': 3.5,
        '킹스맨:골든서클': 3.0,
        'The Night Listener': 4.5,
        '범죄도시': 4.0,
        '아이 캔 스피크': 2.5
    },
    '임명진': {
        '택시운전사': 3.0,
        '남한산성': 4.0,
        '킹스맨:골든서클': 2.0,
        '범죄도시': 3.0,
        'The Night Listener': 3.5,
        '아이 캔 스피크': 2.0
    },
    '심수정': {
        '택시운전사': 3.0,
        '남한산성': 4.0,
        'The Night Listener': 3.0,
        '범죄도시': 5.0,
        '아이 캔 스피크': 3.5
    },
    '박병관': {
        'The Night Listener': 3.0,
        '남한산성': 4.5,
        '아이 캔 스피크': 1.0,
        '범죄도시': 4.0
    }
}

# 두 사람간에 피어슨 상관계수를 구하기 위한 메서드이다.(단, 비교 아이템은 여러개이다.)
# def sim_pearson(data, name1, name2):
#     sumX=0 # X의 합
#     sumY=0 # Y의 합
#     sumPowX=0 # X 제곱의 합
#     sumPowY=0 # Y 제곱의 합
#     sumXY=0 # X*Y의 합
#     count=0 #영화 개수
#
#     # data = repr(data).decode('string-escape')//이것을 하는순간 dict가 str이 돼버린다.
#     # print type(data)
#     for i in data[name1]: # i = key
#         if i in data[name2]: # 같은 영화를 평가했을때만
#             sumX+=data[name1][i]
#             sumY+=data[name2][i]
#             sumPowX+=pow(data[name1][i],2)
#             sumPowY+=pow(data[name2][i],2)
#             sumXY+=data[name1][i]*data[name2][i]
#             count+=1
#
#
#             #이로써 views데이터가 이 메소드까지 들어오는것을 확인했다.
#     print sumX, sumY, sumPowX, sumPowY, sumXY, count, data[name1][i], data[name2][i]
#     return ( sumXY- ((sumX*sumY)/count) )/ sqrt( (sumPowX - (pow(sumX,2) / count)) * (sumPowY - (pow(sumY,2)/count)))
def sim_pearson(data, name1, name2):
    sum=0
    for i in data[name1]:
        if i in data[name2]: #같은 영화를 봤다면
            sum+=pow(data[name1][i]- data[name2][i],2)

    return 1/(1+sqrt(sum))

# print sim_pearson(critics, 'emlwlsek1234@naver.com','a01039329810@gmail.com')
# 피어슨 상관계수를 이용하여 기준이 되는 사용자와 모든 이용자와의 거리를 구한다. 이때, 몇명을 참고할지는 index에 따른다.
def top_match(data, name, index=3, sim_function=sim_pearson):
    li=[]
    for i in data: #딕셔너리를 돌고
        if name!=i: #자기 자신이 아닐때만
            li.append((sim_function(data,name,i),i)) #sim_function()을 통해 상관계수를 구하고 li[]에 추가
    li.sort() #오름차순
    li.reverse() #내림차순
    return li[:index]

# 위를 통해 평점을 예측한다.
def getRecommendation (data,person,sim_function=sim_pearson):
    result = top_match(critics, person ,len(data))

    simSum=0 # 유사도 합을 위한 변수
    score=0 # 평점 합을 위한 변수
    li=[] # 리턴을 위한 리스트
    score_dic={} # 유사도 총합을 위한 dic
    sim_dic={} # 평점 총합을 위한 dic

    for sim,name in result: # 튜플이므로 한번에
        if sim<0 : continue #유사도가 양수인 사람만
        for movie in data[name]:
            if movie not in data[person]: #name이 평가를 내리지 않은 영화
                score+=sim*data[name][movie] # 그사람의 영화평점 * 유사도
                score_dic.setdefault(movie,0) # 기본값 설정
                score_dic[movie]+=score # 합계 구함

                # 조건에 맞는 사람의 유사도의 누적합을 구한다
                sim_dic.setdefault(movie,0)
                sim_dic[movie]+=sim

            score=0  #영화가 바뀌었으니 초기화한다

    for key in score_dic:
        score_dic[key]=score_dic[key]/sim_dic[key] # 평점 총합/ 유사도 총합
        #li.append((score_dic[key],key)) # list((tuple))의 리턴을 위해서.
        li.append(key)
    li.sort() #오름차순
    li.reverse() #내림차순
    return li

# critics = literal_eval(sys.argv[1])

data = literal_eval(sys.argv[1])
email = data['email']
critics = data['views']
# print type(data['views'])
# print repr(getRecommendation(critics, 'emlwlsek1234@naver.com')).decode('string-escape')
# print repr(getRecommendation(critics, 'emlwlsek1234@naver.com')).decode('string-escape')
print repr(getRecommendation(critics, email)).decode('string-escape')
