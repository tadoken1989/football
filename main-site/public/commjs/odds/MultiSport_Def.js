// JScript 檔
var COMMON_DEF = new Array();
COMMON_DEF[0] = new Array("MUID", "MatchId", "MatchCode", "MatchCount", "LeagueId", "LeagueName", "HomeName", "AwayName", "KickoffTime", "StatsId", "SportRadar", "StreamingId", "ShowTime", "HasLive", "Favorite", "TimerSuspend", "FavLeague");
COMMON_DEF[1] = new Array("SportType");
COMMON_DEF[2] = new Array("Combo");
COMMON_DEF[3] = new Array("IsMainMarket");
//for soccer more
COMMON_DEF[4] = new Array("Category", "HotEvent", "MatchId");
COMMON_DEF[5] = new Array("Category", "HotEvent", "MatchId", "LeagueName", "HomeName", "AwayName", "ScoreH", "ScoreA");


var FIELDS_DEF = new Array();
FIELDS_DEF[0] = new Array("FlagLive", "LivePeriod", "CsStatus", "InjuryTime", "ScoreH", "ScoreA");
FIELDS_DEF[5] = new Array("MoreCount");
FIELDS_DEF[1] = new Array("RedCardH", "RedCardA", "MoreCount");
FIELDS_DEF[2] = new Array("MoreCount");
FIELDS_DEF[8] = new Array("PitcherH", "PitcherA");
FIELDS_DEF[161] = new Array("RedCardH", "RedCardA", "MoreCount", "Ball1", "Ball2");
//FIELDS_DEF[161] = new Array("RedCardH","RedCardA");
var ExtFIELDS_DEF = new Array();
ExtFIELDS_DEF[1] = new Array("IsBetTrade", "IsFastMarket", "IsCashOut");

var MultiSportODDS_DEF = new Array();
MultiSportODDS_DEF[0] = new Array("OddsId_0", "Odds_0"); // Outright
MultiSportODDS_DEF[1] = new Array("OddsId_1", "Value_1", "Odds_1_H", "Odds_1_A", "FavorF");
MultiSportODDS_DEF[2] = new Array("OddsId_2", "Odds_2_O", "Odds_2_E");
MultiSportODDS_DEF[3] = new Array("OddsId_3", "Goal_3", "Odds_3_O", "Odds_3_U");
MultiSportODDS_DEF[4] = new Array("OddsId_4", "Odds_4_00", "Odds_4_01", "Odds_4_02", "Odds_4_03", "Odds_4_04", "Odds_4_05", "Odds_4_10", "Odds_4_11", "Odds_4_12", "Odds_4_13", "Odds_4_14", "Odds_4_20", "Odds_4_21", "Odds_4_22", "Odds_4_23", "Odds_4_24", "Odds_4_30", "Odds_4_31", "Odds_4_32", "Odds_4_33", "Odds_4_34", "Odds_4_40", "Odds_4_41", "Odds_4_42", "Odds_4_43", "Odds_4_44", "Odds_4_50");
MultiSportODDS_DEF[5] = new Array("OddsId_5", "Odds_5_1", "Odds_5_X", "Odds_5_2");
MultiSportODDS_DEF[6] = new Array("OddsId_6", "Odds_6_01", "Odds_6_23", "Odds_6_46", "Odds_6_7");
MultiSportODDS_DEF[7] = new Array("OddsId_7", "Value_7", "Odds_7_H", "Odds_7_A", "FavorH1");
MultiSportODDS_DEF[8] = new Array("OddsId_8", "Goal_8", "Odds_8_O", "Odds_8_U");
MultiSportODDS_DEF[11] = new Array("OddsId_11", "Odds_11_08", "Odds_11_911", "Odds_11_12");
MultiSportODDS_DEF[12] = new Array("OddsId_12", "Odds_12_O", "Odds_12_E");
MultiSportODDS_DEF[14] = new Array("OddsId_14", "Odds_14_NO", "Odds_14_HF", "Odds_14_HL", "Odds_14_AF", "Odds_14_AL");
MultiSportODDS_DEF[15] = new Array("OddsId_15", "Odds_15_1", "Odds_15_X", "Odds_15_2");
MultiSportODDS_DEF[16] = new Array("OddsId_16", "Odds_16_HH", "Odds_16_HD", "Odds_16_HA", "Odds_16_DH", "Odds_16_DD", "Odds_16_DA", "Odds_16_AH", "Odds_16_AD", "Odds_16_AA");
MultiSportODDS_DEF[17] = new Array("OddsId_17", "Value_17", "Odds_17_H", "Odds_17_A", "FavorF_17");
MultiSportODDS_DEF[18] = new Array("OddsId_18", "Goal_18", "Odds_18_O", "Odds_18_U");
MultiSportODDS_DEF[20] = new Array("OddsId_20", "Odds_20_H", "Odds_20_A");
MultiSportODDS_DEF[21] = new Array("OddsId_21", "Odds_21_H", "Odds_21_A");
MultiSportODDS_DEF[22] = new Array("OddsId_22", "Odds_22_1", "Odds_22_X", "Odds_22_2");
MultiSportODDS_DEF[30] = new Array("OddsId_30", "Odds_30_00", "Odds_30_01", "Odds_30_02", "Odds_30_03", "Odds_30_04", "Odds_30_10", "Odds_30_11", "Odds_30_12", "Odds_30_13", "Odds_30_20", "Odds_30_21", "Odds_30_22", "Odds_30_23", "Odds_30_30", "Odds_30_31", "Odds_30_32", "Odds_30_33", "Odds_30_40");
MultiSportODDS_DEF[81] = new Array("OddsId_81", "Goal_81", "Odds_81_O", "Odds_81_U");
MultiSportODDS_DEF[82] = new Array("OddsId_82", "Goal_82", "Odds_82_O", "Odds_82_U");
MultiSportODDS_DEF[83] = new Array("OddsId_83", "Odds_83_O", "Odds_83_E");
MultiSportODDS_DEF[84] = new Array("OddsId_84", "Odds_84_O", "Odds_84_E");
MultiSportODDS_DEF[85] = new Array("OddsId_85", "Goal_85", "Odds_85_O", "Odds_85_U");
MultiSportODDS_DEF[86] = new Array("OddsId_86", "Odds_86_O", "Odds_86_E");
MultiSportODDS_DEF[87] = new Array("OddsId_87", "Goal_87", "Odds_87_H", "Odds_87_L");
MultiSportODDS_DEF[88] = new Array("OddsId_88", "Odds_88_H", "Odds_88_A");
MultiSportODDS_DEF[89] = new Array("OddsId_89", "Odds_89_OO", "Odds_89_UO", "Odds_89_OE", "Odds_89_UE");
//pop odds 5,15,24,25,26,27,13,28,121,122,123, 2,6,14,16,4, 90
MultiSportODDS_DEF[901] = new Array("OddsId_901", "Odds_90_1_1", "Odds_90_1_2", "Odds_90_1_3", "Odds_90_1_4", "Odds_90_1_5", "Odds_90_1_6", "Odds_90_1_7", "Odds_90_1_8", "Odds_90_1_9", "Odds_90_1_10", "Odds_90_1_11", "Odds_90_1_12", "Odds_90_1_13", "Odds_90_1_14", "Odds_90_1_15");
MultiSportODDS_DEF[902] = new Array("OddsId_902", "Odds_90_2_1", "Odds_90_2_2", "Odds_90_2_3", "Odds_90_2_4", "Odds_90_2_5");
MultiSportODDS_DEF[903] = new Array("OddsId_903", "Odds_90_3_1", "Odds_90_3_2", "Odds_90_3_3");
MultiSportODDS_DEF[904] = new Array("OddsId_904", "Odds_90_4_1", "Odds_90_4_2", "Odds_90_4_3", "Odds_90_4_4", "Odds_90_4_5");
MultiSportODDS_DEF[905] = new Array("OddsId_905", "Odds_90_5_1", "Odds_90_5_2", "Odds_90_5_3", "Odds_90_5_4", "Odds_90_5_5",
                                                  "Odds_90_5_6", "Odds_90_5_7", "Odds_90_5_8", "Odds_90_5_9", "Odds_90_5_10",
                                                  "Odds_90_5_11", "Odds_90_5_12", "Odds_90_5_13", "Odds_90_5_14", "Odds_90_5_15",
                                                  "Odds_90_5_16", "Odds_90_5_17", "Odds_90_5_18", "Odds_90_5_19", "Odds_90_5_20",
                                                  "Odds_90_5_21", "Odds_90_5_22", "Odds_90_5_23", "Odds_90_5_24", "Odds_90_5_25",
                                                  "Odds_90_5_26", "Odds_90_5_27", "Odds_90_5_28", "Odds_90_5_29", "Odds_90_5_30",
                                                  "Odds_90_5_31", "Odds_90_5_32", "Odds_90_5_33", "Odds_90_5_34", "Odds_90_5_35",
                                                  "Odds_90_5_36", "Odds_90_5_37", "Odds_90_5_38", "Odds_90_5_39", "Odds_90_5_40",
                                                  "Odds_90_5_41", "Odds_90_5_42", "Odds_90_5_43", "Odds_90_5_44", "Odds_90_5_45",
                                                  "Odds_90_5_46", "Odds_90_5_47", "Odds_90_5_48", "Odds_90_5_49", "Odds_90_5_50",
                                                  "Odds_90_5_51", "Odds_90_5_52", "Odds_90_5_53", "Odds_90_5_54", "Odds_90_5_55",
                                                  "Odds_90_5_56", "Odds_90_5_57", "Odds_90_5_58", "Odds_90_5_59", "Odds_90_5_60",
                                                  "Odds_90_5_61", "Odds_90_5_62", "Odds_90_5_63", "Odds_90_5_64", "Odds_90_5_65",
                                                  "Odds_90_5_66", "Odds_90_5_67", "Odds_90_5_68", "Odds_90_5_69", "Odds_90_5_70",
                                                  "Odds_90_5_71", "Odds_90_5_72", "Odds_90_5_73", "Odds_90_5_74", "Odds_90_5_75");
MultiSportODDS_DEF[90] = MultiSportODDS_DEF[901].concat(MultiSportODDS_DEF[902]).concat(MultiSportODDS_DEF[903]).concat(MultiSportODDS_DEF[904]).concat(MultiSportODDS_DEF[905]);
MultiSportODDS_DEF[24] = new Array("OddsId_24", "Odds_24_1X", "Odds_24_12", "Odds_24_2X");
MultiSportODDS_DEF[25] = new Array("OddsId_25", "Odds_25_H", "Odds_25_A");
MultiSportODDS_DEF[26] = new Array("OddsId_26", "Odds_26_O", "Odds_26_N", "Odds_26_B");
MultiSportODDS_DEF[27] = new Array("OddsId_27", "Odds_27_H", "Odds_27_A");
MultiSportODDS_DEF[13] = new Array("OddsId_13", "Odds_13_HY", "Odds_13_HN", "Odds_13_AY", "Odds_13_AN");
MultiSportODDS_DEF[28] = new Array("OddsId_28", "Odds_28_1", "Odds_28_X", "Odds_28_2", "Odds_28_hdp1", "Odds_28_hdpx", "Odds_28_hdp2");
MultiSportODDS_DEF[121] = new Array("OddsId_121", "Odds_121_A", "Odds_121_H");
MultiSportODDS_DEF[122] = new Array("OddsId_122", "Odds_122_H", "Odds_122_X");
MultiSportODDS_DEF[123] = new Array("OddsId_123", "Odds_123_H", "Odds_123_A");
MultiSportODDS_DEF[126] = new Array("OddsId_126", "Odds_126_01", "Odds_126_23", "Odds_126_4");
MultiSportODDS_DEF[127] = new Array("OddsId_127", "Odds_127_NO", "Odds_127_HF", "Odds_127_HL", "Odds_127_AF", "Odds_127_AL");
MultiSportODDS_DEF[128] = new Array("OddsId_128", "Odds_128_OO", "Odds_128_OE", "Odds_128_EO", "Odds_128_EE");

//Betradar New Bettype
MultiSportODDS_DEF[133] = new Array("OddsId_133", "Odds_133_HY", "Odds_133_HN");
MultiSportODDS_DEF[134] = new Array("OddsId_134", "Odds_134_AY", "Odds_134_AN");
MultiSportODDS_DEF[135] = new Array("OddsId_135", "Odds_135_Y", "Odds_135_N");
MultiSportODDS_DEF[140] = new Array("OddsId_140", "Odds_140_1H", "Odds_140_2H", "Odds_140_TIE");
MultiSportODDS_DEF[141] = new Array("OddsId_141", "Odds_141_1H", "Odds_141_2H", "Odds_141_TIE");
MultiSportODDS_DEF[142] = new Array("OddsId_142", "Odds_142_1H", "Odds_142_2H", "Odds_142_TIE");
MultiSportODDS_DEF[145] = new Array("OddsId_145", "Odds_145_Y", "Odds_145_N");
MultiSportODDS_DEF[146] = new Array("OddsId_146", "Odds_146_Y", "Odds_146_N");
MultiSportODDS_DEF[147] = new Array("OddsId_147", "Odds_147_HY", "Odds_147_HN");
MultiSportODDS_DEF[148] = new Array("OddsId_148", "Odds_148_AY", "Odds_148_AN");
MultiSportODDS_DEF[149] = new Array("OddsId_149", "Odds_149_HY", "Odds_149_HN");
MultiSportODDS_DEF[150] = new Array("OddsId_150", "Odds_150_AY", "Odds_150_AN");
MultiSportODDS_DEF[151] = new Array("OddsId_151", "Odds_151_1X", "Odds_151_2X", "Odds_151_12");
MultiSportODDS_DEF[152] = new Array("OddsId_152", "Odds_152_0000", "Odds_152_0010", "Odds_152_0001",
                                                  "Odds_152_0020", "Odds_152_0011", "Odds_152_0002",
                                                  "Odds_152_0030", "Odds_152_0021", "Odds_152_0012",
                                                  "Odds_152_0003", "Odds_152_004UP", "Odds_152_1010",
                                                  "Odds_152_1020", "Odds_152_1011", "Odds_152_1030",
                                                  "Odds_152_1021", "Odds_152_1012", "Odds_152_104UP",
                                                  "Odds_152_0101", "Odds_152_0111", "Odds_152_0102",
                                                  "Odds_152_0121", "Odds_152_0112", "Odds_152_0103",
                                                  "Odds_152_014UP", "Odds_152_1111", "Odds_152_1121",
                                                  "Odds_152_1112", "Odds_152_114UP", "Odds_152_2020",
                                                  "Odds_152_2030", "Odds_152_2021", "Odds_152_204UP",
                                                  "Odds_152_0202", "Odds_152_0212", "Odds_152_0203",
                                                  "Odds_152_024UP", "Odds_152_2121", "Odds_152_214UP",
                                                  "Odds_152_1212", "Odds_152_124UP", "Odds_152_3030",
                                                  "Odds_152_304UP", "Odds_152_0303", "Odds_152_034UP",
                                                  "Odds_152_4UP4UP");

MultiSportODDS_DEF[153] = new Array("OddsId_153", "Value_153", "Odds_153_H", "Odds_153_A", "FavorF_153");
MultiSportODDS_DEF[154] = new Array("OddsId", "Odds_0", "Odds_1", "Resourceid");
MultiSportODDS_DEF[155] = new Array("OddsId", "Value", "Odds_0", "Odds_1", "FavorF", "Resourceid");
MultiSportODDS_DEF[156] = new Array("OddsId", "Goal", "Odds_0", "Odds_1", "Resourceid");


MultiSportODDS_DEF[185] = new Array("OddsId_185", "Odds_185_H", "Odds_185_A");
MultiSportODDS_DEF[191] = new Array("OddsId_191", "Odds_191_H", "Odds_191_A");
MultiSportODDS_DEF[178] = new Array("OddsId_178", "Goal_178", "Odds_178_O", "Odds_178_U");
MultiSportODDS_DEF[204] = new Array("OddsId_204", "Goal_204", "Odds_204_O", "Odds_204_U");
MultiSportODDS_DEF[205] = new Array("OddsId_205", "Goal_205", "Odds_205_O", "Odds_205_U");
MultiSportODDS_DEF[189] = new Array("OddsId_189", "Odds_189_Y", "Odds_189_N");
MultiSportODDS_DEF[190] = new Array("OddsId_190", "Odds_190_Y", "Odds_190_N");
MultiSportODDS_DEF[197] = new Array("OddsId_197", "Goal_197", "Odds_197_O", "Odds_197_U");
MultiSportODDS_DEF[198] = new Array("OddsId_198", "Goal_198", "Odds_198_O", "Odds_198_U");
MultiSportODDS_DEF[167] = new Array("OddsId_167", "Odds_167_1", "Odds_167_X", "Odds_167_2");
MultiSportODDS_DEF[176] = new Array("OddsId_176", "Odds_176_1", "Odds_176_X", "Odds_176_2");
MultiSportODDS_DEF[177] = new Array("OddsId_177", "Odds_177_1", "Odds_177_X", "Odds_177_2");
MultiSportODDS_DEF[157] = new Array("OddsId_157", "Odds_157_O", "Odds_157_E");
MultiSportODDS_DEF[184] = new Array("OddsId_184", "Odds_184_O", "Odds_184_E");
MultiSportODDS_DEF[194] = new Array("OddsId_194", "Odds_194_O", "Odds_194_E");
MultiSportODDS_DEF[203] = new Array("OddsId_203", "Odds_203_O", "Odds_203_E");
MultiSportODDS_DEF[165] = new Array("OddsId_165", "Odds_165_00", "Odds_165_10", "Odds_165_20", "Odds_165_01", "Odds_165_11", "Odds_4_02");
MultiSportODDS_DEF[166] = new Array("OddsId_166", "Odds_166_00", "Odds_166_10", "Odds_166_20", "Odds_166_30", "Odds_166_01", "Odds_166_11", "Odds_166_21", "Odds_166_02", "Odds_166_12", "Odds_166_03");
MultiSportODDS_DEF[159] = new Array("OddsId_159", "Odds_159_G1", "Odds_159_G2", "Odds_159_G3", "Odds_159_G4", "Odds_159_G5", "Odds_159_G6", "Odds_159_G0");
MultiSportODDS_DEF[161] = new Array("OddsId_161", "Odds_161_G0", "Odds_161_G1", "Odds_161_G2", "Odds_161_G3");
MultiSportODDS_DEF[162] = new Array("OddsId_162", "Odds_162_G0", "Odds_162_G1", "Odds_162_G2", "Odds_162_G3");
MultiSportODDS_DEF[179] = new Array("OddsId_179", "Odds_179_G0", "Odds_179_G1", "Odds_179_G2", "Odds_179_G3", "Odds_179_G4");
MultiSportODDS_DEF[181] = new Array("OddsId_181", "Odds_181_G0", "Odds_181_G1", "Odds_181_G2", "Odds_181_G3");
MultiSportODDS_DEF[182] = new Array("OddsId_182", "Odds_182_G0", "Odds_182_G1", "Odds_182_G2", "Odds_182_G3");
MultiSportODDS_DEF[187] = new Array("OddsId_187", "Odds_187_G0", "Odds_187_G1", "Odds_187_G2");

MultiSportODDS_DEF[143] = new Array("OddsId_143", "Goal_143", "Odds_143_HU", "Odds_143_HO", "Odds_143_DU", "Odds_143_DO", "Odds_143_AU", "Odds_143_AO");
MultiSportODDS_DEF[144] = new Array("OddsId_144", "Goal_144", "Odds_144_HU", "Odds_144_HO", "Odds_144_DU", "Odds_144_DO", "Odds_144_AU", "Odds_144_AO");
MultiSportODDS_DEF[164] = new Array("OddsId_164", "Odds_164_1", "Odds_164_X", "Odds_164_2");
MultiSportODDS_DEF[168] = new Array("OddsId_168", "Odds_168_H", "Odds_168_A");
MultiSportODDS_DEF[169] = new Array("OddsId_169", "Odds_169_115", "Odds_169_1630", "Odds_169_3145", "Odds_169_4660", "Odds_169_6175", "Odds_169_7690");
MultiSportODDS_DEF[170] = new Array("OddsId_170", "Odds_170_H", "Odds_170_A", "Odds_170_B", "Odds_170_N");
MultiSportODDS_DEF[171] = new Array("OddsId_171", "Odds_171_H1", "Odds_171_H2", "Odds_171_H3", "Odds_171_A1", "Odds_171_A2", "Odds_171_A3", "Odds_171_NG", "Odds_171_D");
MultiSportODDS_DEF[172] = new Array("OddsId_172", "Odds_172_HH", "Odds_172_DH", "Odds_172_AH", "Odds_172_HA", "Odds_172_DA", "Odds_172_AA", "Odds_172_NO");
MultiSportODDS_DEF[173] = new Array("OddsId_173", "Odds_173_Y", "Odds_173_N");
MultiSportODDS_DEF[174] = new Array("OddsId_174", "Odds_174_Y", "Odds_174_N");
MultiSportODDS_DEF[175] = new Array("OddsId_175", "Odds_175_HR", "Odds_175_HE", "Odds_175_HP", "Odds_175_AR", "Odds_175_AE", "Odds_175_AP");
MultiSportODDS_DEF[180] = new Array("OddsId_180", "Odds_180_1", "Odds_180_X", "Odds_180_2");
MultiSportODDS_DEF[186] = new Array("OddsId_186", "Odds_186_HD", "Odds_186_HA", "Odds_186_DA");
MultiSportODDS_DEF[188] = new Array("OddsId_188", "Odds_188_Y", "Odds_188_N");
MultiSportODDS_DEF[192] = new Array("OddsId_192", "Odds_192_110", "Odds_192_1120", "Odds_192_2130", "Odds_192_3140", "Odds_192_4150", "Odds_192_5160", "Odds_192_6170", "Odds_192_7180", "Odds_192_8190");
MultiSportODDS_DEF[193] = new Array("OddsId_193", "Odds_193_115", "Odds_193_1630", "Odds_193_3145", "Odds_193_4660", "Odds_193_6175", "Odds_193_7690");
MultiSportODDS_DEF[195] = new Array("OddsId_195", "Odds_195_02", "Odds_195_34", "Odds_195_56", "Odds_195_7");
MultiSportODDS_DEF[196] = new Array("OddsId_196", "Odds_196_02", "Odds_196_34", "Odds_196_56", "Odds_196_7");
MultiSportODDS_DEF[200] = new Array("OddsId_200", "Odds_200_01", "Odds_200_2", "Odds_200_3", "Odds_200_4");
MultiSportODDS_DEF[201] = new Array("OddsId_201", "Odds_201_01", "Odds_201_2", "Odds_201_3", "Odds_201_4");
MultiSportODDS_DEF[202] = new Array("OddsId_202", "Odds_202_04", "Odds_202_56", "Odds_202_7");
MultiSportODDS_DEF[206] = new Array("OddsId_206", "Odds_206_H", "Odds_206_A", "Odds_206_N");
MultiSportODDS_DEF[207] = new Array("OddsId_207", "Odds_207_H", "Odds_207_A", "Odds_207_N");
MultiSportODDS_DEF[208] = new Array("OddsId_208", "Odds_208_H", "Odds_208_A", "Odds_208_N");
MultiSportODDS_DEF[209] = new Array("OddsId_209", "Odds_209_H", "Odds_209_A", "Odds_209_N");
MultiSportODDS_DEF[210] = new Array("OddsId_210", "Odds_210_Y", "Odds_210_N");
MultiSportODDS_DEF[211] = new Array("OddsId_211", "Odds_211_Y", "Odds_211_N");
MultiSportODDS_DEF[212] = new Array("OddsId_212", "Odds_212_Y", "Odds_212_N");
MultiSportODDS_DEF[213] = new Array("OddsId_213", "Odds_213_Y", "Odds_213_N");
MultiSportODDS_DEF[214] = new Array("OddsId_214", "Odds_214_Y", "Odds_214_N");
MultiSportODDS_DEF[215] = new Array("OddsId_215", "Odds_215_Y", "Odds_215_N");
MultiSportODDS_DEF[216] = new Array("OddsId_216", "Odds_216_C01", "Odds_216_P01", "Odds_216_I01", "Odds_216_C02", "Odds_216_P02", "Odds_216_I02", "Odds_216_C03", "Odds_216_P03", "Odds_216_I03", "Odds_216_C04", "Odds_216_P04", "Odds_216_I04", "Odds_216_C05", "Odds_216_P05", "Odds_216_I05",
 "Odds_216_C06", "Odds_216_P06", "Odds_216_I06", "Odds_216_C07", "Odds_216_P07", "Odds_216_I07", "Odds_216_C08", "Odds_216_P08", "Odds_216_I08", "Odds_216_C09", "Odds_216_P09", "Odds_216_I09", "Odds_216_C10", "Odds_216_P10", "Odds_216_I10",
 "Odds_216_C11", "Odds_216_P11", "Odds_216_I11", "Odds_216_C12", "Odds_216_P12", "Odds_216_I12", "Odds_216_C13", "Odds_216_P13", "Odds_216_I13", "Odds_216_C14", "Odds_216_P14", "Odds_216_I14", "Odds_216_C15", "Odds_216_P15", "Odds_216_I15",
 "Odds_216_C16", "Odds_216_P16", "Odds_216_I16", "Odds_216_C17", "Odds_216_P17", "Odds_216_I17", "Odds_216_C18", "Odds_216_P18", "Odds_216_I18", "Odds_216_C19", "Odds_216_P19", "Odds_216_I19", "Odds_216_C20", "Odds_216_P20", "Odds_216_I20",
 "Odds_216_C21", "Odds_216_P21", "Odds_216_I21", "Odds_216_C22", "Odds_216_P22", "Odds_216_I22", "Odds_216_C23", "Odds_216_P23", "Odds_216_I23", "Odds_216_C24", "Odds_216_P24", "Odds_216_I24", "Odds_216_C25", "Odds_216_P25", "Odds_216_I25",
 "Odds_216_C26", "Odds_216_P26", "Odds_216_I26", "Odds_216_C27", "Odds_216_P27", "Odds_216_I27", "Odds_216_C28", "Odds_216_P28", "Odds_216_I28", "Odds_216_C29", "Odds_216_P29", "Odds_216_I29", "Odds_216_C30", "Odds_216_P30", "Odds_216_I30",
 "Odds_216_C31", "Odds_216_P31", "Odds_216_I31", "Odds_216_C32", "Odds_216_P32", "Odds_216_I32", "Odds_216_C33", "Odds_216_P33", "Odds_216_I33", "Odds_216_C34", "Odds_216_P34", "Odds_216_I34", "Odds_216_C35", "Odds_216_P35", "Odds_216_I35",
 "Odds_216_C36", "Odds_216_P36", "Odds_216_I36", "Odds_216_C37", "Odds_216_P37", "Odds_216_I37", "Odds_216_C38", "Odds_216_P38", "Odds_216_I38", "Odds_216_C39", "Odds_216_P39", "Odds_216_I39", "Odds_216_C40", "Odds_216_P40", "Odds_216_I40",
 "Odds_216_C41", "Odds_216_P41", "Odds_216_I41", "Odds_216_C42", "Odds_216_P42", "Odds_216_I42", "Odds_216_C43", "Odds_216_P43", "Odds_216_I43", "Odds_216_C44", "Odds_216_P44", "Odds_216_I44", "Odds_216_C45", "Odds_216_P45", "Odds_216_I45",
 "Odds_216_C46", "Odds_216_P46", "Odds_216_I46", "Odds_216_C47", "Odds_216_P47", "Odds_216_I47", "Odds_216_C48", "Odds_216_P48", "Odds_216_I48", "Odds_216_C49", "Odds_216_P49", "Odds_216_I49", "Odds_216_C50", "Odds_216_P50", "Odds_216_I50",
 "Odds_216_C51", "Odds_216_P51", "Odds_216_I51", "Odds_216_C52", "Odds_216_P52", "Odds_216_I52", "Odds_216_C53", "Odds_216_P53", "Odds_216_I53", "Odds_216_C54", "Odds_216_P54", "Odds_216_I54", "Odds_216_C55", "Odds_216_P55", "Odds_216_I55",
 "Odds_216_C56", "Odds_216_P56", "Odds_216_I56", "Odds_216_C57", "Odds_216_P57", "Odds_216_I57", "Odds_216_C58", "Odds_216_P58", "Odds_216_I58", "Odds_216_C59", "Odds_216_P59", "Odds_216_I59", "Odds_216_C60", "Odds_216_P60", "Odds_216_I60",
 "Odds_216_C61", "Odds_216_P61", "Odds_216_I61", "Odds_216_C62", "Odds_216_P62", "Odds_216_I62", "Odds_216_C63", "Odds_216_P63", "Odds_216_I63", "Odds_216_C64", "Odds_216_P64", "Odds_216_I64", "Odds_216_C65", "Odds_216_P65", "Odds_216_I65",
 "Odds_216_C66", "Odds_216_P66", "Odds_216_I66", "Odds_216_C67", "Odds_216_P67", "Odds_216_I67", "Odds_216_C68", "Odds_216_P68", "Odds_216_I68", "Odds_216_C69", "Odds_216_P69", "Odds_216_I69", "Odds_216_C70", "Odds_216_P70", "Odds_216_I70",
 "Odds_216_C71", "Odds_216_P71", "Odds_216_I71", "Odds_216_C72", "Odds_216_P72", "Odds_216_I72", "Odds_216_C73", "Odds_216_P73", "Odds_216_I73", "Odds_216_C74", "Odds_216_P74", "Odds_216_I74", "Odds_216_C75", "Odds_216_P75", "Odds_216_I75",
 "Odds_216_C76", "Odds_216_P76", "Odds_216_I76", "Odds_216_C77", "Odds_216_P77", "Odds_216_I77", "Odds_216_C78", "Odds_216_P78", "Odds_216_I78", "Odds_216_C79", "Odds_216_P79", "Odds_216_I79", "Odds_216_C80", "Odds_216_P80", "Odds_216_I80",
 "Odds_216_C81", "Odds_216_P81", "Odds_216_I81", "Odds_216_C82", "Odds_216_P82", "Odds_216_I82", "Odds_216_C83", "Odds_216_P83", "Odds_216_I83", "Odds_216_C84", "Odds_216_P84", "Odds_216_I84", "Odds_216_C85", "Odds_216_P85", "Odds_216_I85",
 "Odds_216_C86", "Odds_216_P86", "Odds_216_I86", "Odds_216_C87", "Odds_216_P87", "Odds_216_I87", "Odds_216_C88", "Odds_216_P88", "Odds_216_I88", "Odds_216_C89", "Odds_216_P89", "Odds_216_I89", "Odds_216_C90", "Odds_216_P90", "Odds_216_I90",
 "Odds_216_C91", "Odds_216_P91", "Odds_216_I91", "Odds_216_C92", "Odds_216_P92", "Odds_216_I92", "Odds_216_C93", "Odds_216_P93", "Odds_216_I93", "Odds_216_C94", "Odds_216_P94", "Odds_216_I94", "Odds_216_C95", "Odds_216_P95", "Odds_216_I95",
 "Odds_216_C96", "Odds_216_P96", "Odds_216_I96", "Odds_216_C97", "Odds_216_P97", "Odds_216_I97", "Odds_216_C98", "Odds_216_P98", "Odds_216_I98", "Odds_216_C99", "Odds_216_P99", "Odds_216_I99");
MultiSportODDS_DEF[217] = new Array("OddsId_217", "Odds_217_C01", "Odds_217_P01", "Odds_217_I01", "Odds_217_C02", "Odds_217_P02", "Odds_217_I02", "Odds_217_C03", "Odds_217_P03", "Odds_217_I03", "Odds_217_C04", "Odds_217_P04", "Odds_217_I04", "Odds_217_C05", "Odds_217_P05", "Odds_217_I05",
 "Odds_217_C06", "Odds_217_P06", "Odds_217_I06", "Odds_217_C07", "Odds_217_P07", "Odds_217_I07", "Odds_217_C08", "Odds_217_P08", "Odds_217_I08", "Odds_217_C09", "Odds_217_P09", "Odds_217_I09", "Odds_217_C10", "Odds_217_P10", "Odds_217_I10",
 "Odds_217_C11", "Odds_217_P11", "Odds_217_I11", "Odds_217_C12", "Odds_217_P12", "Odds_217_I12", "Odds_217_C13", "Odds_217_P13", "Odds_217_I13", "Odds_217_C14", "Odds_217_P14", "Odds_217_I14", "Odds_217_C15", "Odds_217_P15", "Odds_217_I15",
 "Odds_217_C16", "Odds_217_P16", "Odds_217_I16", "Odds_217_C17", "Odds_217_P17", "Odds_217_I17", "Odds_217_C18", "Odds_217_P18", "Odds_217_I18", "Odds_217_C19", "Odds_217_P19", "Odds_217_I19", "Odds_217_C20", "Odds_217_P20", "Odds_217_I20",
 "Odds_217_C21", "Odds_217_P21", "Odds_217_I21", "Odds_217_C22", "Odds_217_P22", "Odds_217_I22", "Odds_217_C23", "Odds_217_P23", "Odds_217_I23", "Odds_217_C24", "Odds_217_P24", "Odds_217_I24", "Odds_217_C25", "Odds_217_P25", "Odds_217_I25",
 "Odds_217_C26", "Odds_217_P26", "Odds_217_I26", "Odds_217_C27", "Odds_217_P27", "Odds_217_I27", "Odds_217_C28", "Odds_217_P28", "Odds_217_I28", "Odds_217_C29", "Odds_217_P29", "Odds_217_I29", "Odds_217_C30", "Odds_217_P30", "Odds_217_I30",
 "Odds_217_C31", "Odds_217_P31", "Odds_217_I31", "Odds_217_C32", "Odds_217_P32", "Odds_217_I32", "Odds_217_C33", "Odds_217_P33", "Odds_217_I33", "Odds_217_C34", "Odds_217_P34", "Odds_217_I34", "Odds_217_C35", "Odds_217_P35", "Odds_217_I35",
 "Odds_217_C36", "Odds_217_P36", "Odds_217_I36", "Odds_217_C37", "Odds_217_P37", "Odds_217_I37", "Odds_217_C38", "Odds_217_P38", "Odds_217_I38", "Odds_217_C39", "Odds_217_P39", "Odds_217_I39", "Odds_217_C40", "Odds_217_P40", "Odds_217_I40",
 "Odds_217_C41", "Odds_217_P41", "Odds_217_I41", "Odds_217_C42", "Odds_217_P42", "Odds_217_I42", "Odds_217_C43", "Odds_217_P43", "Odds_217_I43", "Odds_217_C44", "Odds_217_P44", "Odds_217_I44", "Odds_217_C45", "Odds_217_P45", "Odds_217_I45",
 "Odds_217_C46", "Odds_217_P46", "Odds_217_I46", "Odds_217_C47", "Odds_217_P47", "Odds_217_I47", "Odds_217_C48", "Odds_217_P48", "Odds_217_I48", "Odds_217_C49", "Odds_217_P49", "Odds_217_I49", "Odds_217_C50", "Odds_217_P50", "Odds_217_I50",
 "Odds_217_C51", "Odds_217_P51", "Odds_217_I51", "Odds_217_C52", "Odds_217_P52", "Odds_217_I52", "Odds_217_C53", "Odds_217_P53", "Odds_217_I53", "Odds_217_C54", "Odds_217_P54", "Odds_217_I54", "Odds_217_C55", "Odds_217_P55", "Odds_217_I55",
 "Odds_217_C56", "Odds_217_P56", "Odds_217_I56", "Odds_217_C57", "Odds_217_P57", "Odds_217_I57", "Odds_217_C58", "Odds_217_P58", "Odds_217_I58", "Odds_217_C59", "Odds_217_P59", "Odds_217_I59", "Odds_217_C60", "Odds_217_P60", "Odds_217_I60",
 "Odds_217_C61", "Odds_217_P61", "Odds_217_I61", "Odds_217_C62", "Odds_217_P62", "Odds_217_I62", "Odds_217_C63", "Odds_217_P63", "Odds_217_I63", "Odds_217_C64", "Odds_217_P64", "Odds_217_I64", "Odds_217_C65", "Odds_217_P65", "Odds_217_I65",
 "Odds_217_C66", "Odds_217_P66", "Odds_217_I66", "Odds_217_C67", "Odds_217_P67", "Odds_217_I67", "Odds_217_C68", "Odds_217_P68", "Odds_217_I68", "Odds_217_C69", "Odds_217_P69", "Odds_217_I69", "Odds_217_C70", "Odds_217_P70", "Odds_217_I70",
 "Odds_217_C71", "Odds_217_P71", "Odds_217_I71", "Odds_217_C72", "Odds_217_P72", "Odds_217_I72", "Odds_217_C73", "Odds_217_P73", "Odds_217_I73", "Odds_217_C74", "Odds_217_P74", "Odds_217_I74", "Odds_217_C75", "Odds_217_P75", "Odds_217_I75",
 "Odds_217_C76", "Odds_217_P76", "Odds_217_I76", "Odds_217_C77", "Odds_217_P77", "Odds_217_I77", "Odds_217_C78", "Odds_217_P78", "Odds_217_I78", "Odds_217_C79", "Odds_217_P79", "Odds_217_I79", "Odds_217_C80", "Odds_217_P80", "Odds_217_I80",
 "Odds_217_C81", "Odds_217_P81", "Odds_217_I81", "Odds_217_C82", "Odds_217_P82", "Odds_217_I82", "Odds_217_C83", "Odds_217_P83", "Odds_217_I83", "Odds_217_C84", "Odds_217_P84", "Odds_217_I84", "Odds_217_C85", "Odds_217_P85", "Odds_217_I85",
 "Odds_217_C86", "Odds_217_P86", "Odds_217_I86", "Odds_217_C87", "Odds_217_P87", "Odds_217_I87", "Odds_217_C88", "Odds_217_P88", "Odds_217_I88", "Odds_217_C89", "Odds_217_P89", "Odds_217_I89", "Odds_217_C90", "Odds_217_P90", "Odds_217_I90",
 "Odds_217_C91", "Odds_217_P91", "Odds_217_I91", "Odds_217_C92", "Odds_217_P92", "Odds_217_I92", "Odds_217_C93", "Odds_217_P93", "Odds_217_I93", "Odds_217_C94", "Odds_217_P94", "Odds_217_I94", "Odds_217_C95", "Odds_217_P95", "Odds_217_I95",
 "Odds_217_C96", "Odds_217_P96", "Odds_217_I96", "Odds_217_C97", "Odds_217_P97", "Odds_217_I97", "Odds_217_C98", "Odds_217_P98", "Odds_217_I98", "Odds_217_C99", "Odds_217_P99", "Odds_217_I99");

//PH-All-IN-ONE
MultiSportODDS_DEF[401] = new Array("OddsId_401", "Goal_401", "Odds_401_O", "Odds_401_U");
MultiSportODDS_DEF[402] = new Array("OddsId_402", "Goal_402", "Odds_402_O", "Odds_402_U");
MultiSportODDS_DEF[403] = new Array("OddsId_403", "Goal_403", "Odds_403_O", "Odds_403_U");
MultiSportODDS_DEF[404] = new Array("OddsId_404", "Goal_404", "Odds_404_O", "Odds_404_U");
MultiSportODDS_DEF[405] = new Array("OddsId_405", "Odds_405_00", "Odds_405_01", "Odds_405_02", "Odds_405_03", "Odds_405_10", "Odds_405_11", "Odds_405_12", "Odds_405_13", "Odds_405_20", "Odds_405_21", "Odds_405_22", "Odds_405_23", "Odds_405_30", "Odds_405_31", "Odds_405_32", "Odds_405_33", "Odds_405_99", "Odds_405_livehomescore", "Odds_405_liveawayscore");
MultiSportODDS_DEF[412] = new Array("OddsId_412", "Odds_412_0", "Odds_412_1", "Odds_412_2", "Odds_412_3");
MultiSportODDS_DEF[413] = new Array("OddsId_413", "Odds_413_00", "Odds_413_01", "Odds_413_02", "Odds_413_03", "Odds_413_04", "Odds_413_10", "Odds_413_11", "Odds_413_12", "Odds_413_13", "Odds_413_14", "Odds_413_20", "Odds_413_21", "Odds_413_22", "Odds_413_23", "Odds_413_24", "Odds_413_30", "Odds_413_31", "Odds_413_32", "Odds_413_33", "Odds_413_34", "Odds_413_40", "Odds_413_41", "Odds_413_42", "Odds_413_43", "Odds_413_44", "Odds_413_99", "Odds_413_livehomescore", "Odds_413_liveawayscore");
MultiSportODDS_DEF[414] = new Array("OddsId_414", "Odds_414_00", "Odds_414_01", "Odds_414_02", "Odds_414_03", "Odds_414_10", "Odds_414_11", "Odds_414_12", "Odds_414_13", "Odds_414_20", "Odds_414_21", "Odds_414_22", "Odds_414_23", "Odds_414_30", "Odds_414_31", "Odds_414_32", "Odds_414_33", "Odds_414_99", "Odds_414_livehomescore", "Odds_414_liveawayscore");


//PH-All-IN-ONE-2b
MultiSportODDS_DEF[416] = new Array("OddsId_416", "Odds_416_0000", "Odds_416_0001", "Odds_416_0002", "Odds_416_0003", "Odds_416_0004",
                                    "Odds_416_0010", "Odds_416_0011", "Odds_416_0012", "Odds_416_0013", "Odds_416_0014",
                                    "Odds_416_0020", "Odds_416_0021", "Odds_416_0022", "Odds_416_0023", "Odds_416_0024",
                                    "Odds_416_0030", "Odds_416_0031", "Odds_416_0032", "Odds_416_0033", "Odds_416_0034",
                                    "Odds_416_0040", "Odds_416_0041", "Odds_416_0042", "Odds_416_0043", "Odds_416_0044", "Odds_416_00AOS",
                                    "Odds_416_0101", "Odds_416_0102", "Odds_416_0103", "Odds_416_0104",
                                    "Odds_416_0111", "Odds_416_0112", "Odds_416_0113", "Odds_416_0114",
                                    "Odds_416_0121", "Odds_416_0122", "Odds_416_0123", "Odds_416_0124",
                                    "Odds_416_0131", "Odds_416_0132", "Odds_416_0133", "Odds_416_0134",
                                    "Odds_416_0141", "Odds_416_0142", "Odds_416_0143", "Odds_416_0144", "Odds_416_01AOS",
                                    "Odds_416_0202", "Odds_416_0203", "Odds_416_0204",
                                    "Odds_416_0212", "Odds_416_0213", "Odds_416_0214",
                                    "Odds_416_0222", "Odds_416_0223", "Odds_416_0224",
                                    "Odds_416_0232", "Odds_416_0233", "Odds_416_0234",
                                    "Odds_416_0242", "Odds_416_0243", "Odds_416_0244", "Odds_416_02AOS",
                                    "Odds_416_0303", "Odds_416_0304",
                                    "Odds_416_0313", "Odds_416_0314",
                                    "Odds_416_0323", "Odds_416_0324",
                                    "Odds_416_0333", "Odds_416_0334",
                                    "Odds_416_0343", "Odds_416_0344", "Odds_416_03AOS",
                                    "Odds_416_1010", "Odds_416_1011", "Odds_416_1012", "Odds_416_1013", "Odds_416_1014",
                                    "Odds_416_1020", "Odds_416_1021", "Odds_416_1022", "Odds_416_1023", "Odds_416_1024",
                                    "Odds_416_1030", "Odds_416_1031", "Odds_416_1032", "Odds_416_1033", "Odds_416_1034",
                                    "Odds_416_1040", "Odds_416_1041", "Odds_416_1042", "Odds_416_1043", "Odds_416_1044", "Odds_416_10AOS",
                                    "Odds_416_1111", "Odds_416_1112", "Odds_416_1113", "Odds_416_1114",
                                    "Odds_416_1121", "Odds_416_1122", "Odds_416_1123", "Odds_416_1124",
                                    "Odds_416_1131", "Odds_416_1132", "Odds_416_1133", "Odds_416_1134",
                                    "Odds_416_1141", "Odds_416_1142", "Odds_416_1143", "Odds_416_1144", "Odds_416_11AOS",
                                    "Odds_416_1212", "Odds_416_1213", "Odds_416_1214",
                                    "Odds_416_1222", "Odds_416_1223", "Odds_416_1224",
                                    "Odds_416_1232", "Odds_416_1233", "Odds_416_1234",
                                    "Odds_416_1242", "Odds_416_1243", "Odds_416_1244", "Odds_416_12AOS",
                                    "Odds_416_1313", "Odds_416_1314",
                                    "Odds_416_1323", "Odds_416_1324",
                                    "Odds_416_1333", "Odds_416_1334",
                                    "Odds_416_1343", "Odds_416_1344", "Odds_416_13AOS",
                                    "Odds_416_2020", "Odds_416_2021", "Odds_416_2022", "Odds_416_2023", "Odds_416_2024",
                                    "Odds_416_2030", "Odds_416_2031", "Odds_416_2032", "Odds_416_2033", "Odds_416_2034",
                                    "Odds_416_2040", "Odds_416_2041", "Odds_416_2042", "Odds_416_2043", "Odds_416_2044", "Odds_416_20AOS",
                                    "Odds_416_2121", "Odds_416_2122", "Odds_416_2123", "Odds_416_2124",
                                    "Odds_416_2131", "Odds_416_2132", "Odds_416_2133", "Odds_416_2134",
                                    "Odds_416_2141", "Odds_416_2142", "Odds_416_2143", "Odds_416_2144", "Odds_416_21AOS",
                                    "Odds_416_2222", "Odds_416_2223", "Odds_416_2224",
                                    "Odds_416_2232", "Odds_416_2233", "Odds_416_2234",
                                    "Odds_416_2242", "Odds_416_2243", "Odds_416_2244", "Odds_416_22AOS",
                                    "Odds_416_2323", "Odds_416_2324",
                                    "Odds_416_2333", "Odds_416_2334",
                                    "Odds_416_2343", "Odds_416_2344", "Odds_416_23AOS",
                                    "Odds_416_3030", "Odds_416_3031", "Odds_416_3032", "Odds_416_3033", "Odds_416_3034",
                                    "Odds_416_3040", "Odds_416_3041", "Odds_416_3042", "Odds_416_3043", "Odds_416_3044", "Odds_416_30AOS",
                                    "Odds_416_3131", "Odds_416_3132", "Odds_416_3133", "Odds_416_3134",
                                    "Odds_416_3141", "Odds_416_3142", "Odds_416_3143", "Odds_416_3144", "Odds_416_31AOS",
                                    "Odds_416_3232", "Odds_416_3233", "Odds_416_3234",
                                    "Odds_416_3242", "Odds_416_3243", "Odds_416_3244", "Odds_416_32AOS",
                                    "Odds_416_3333", "Odds_416_3334",
                                    "Odds_416_3343", "Odds_416_3344", "Odds_416_33AOS");
                                    //"Odds_416_AOS34", "Odds_416_AOS43", "Odds_416_AOS44", "Odds_416_AOSAOS");

MultiSportODDS_DEF[417] = new Array("OddsId_417", "Odds_417_YH", "Odds_417_YA", "Odds_417_YD", "Odds_417_NH", "Odds_417_NA", "Odds_417_ND");
MultiSportODDS_DEF[418] = new Array("OddsId_418", "Goal_418", "Odds_418_YO", "Odds_418_YU", "Odds_418_NO", "Odds_418_NU");
MultiSportODDS_DEF[419] = new Array("OddsId_419", "Odds_419_1H", "Odds_419_2H", "Odds_419_N");
MultiSportODDS_DEF[420] = new Array("OddsId_420", "Odds_420_1H", "Odds_420_2H", "Odds_420_N");
MultiSportODDS_DEF[421] = new Array("OddsId_421", "Odds_421_1H", "Odds_421_2H", "Odds_421_N");
MultiSportODDS_DEF[422] = new Array("OddsId_422", "Odds_422_H", "Odds_422_A", "Odds_422_N");
MultiSportODDS_DEF[423] = new Array("OddsId_423", "Odds_423_H", "Odds_423_A", "Odds_423_N");
MultiSportODDS_DEF[424] = new Array("OddsId_424", "Odds_424_S", "Odds_424_H", "Odds_424_P", "Odds_424_FK", "Odds_424_OG", "Odds_424_NG");
MultiSportODDS_DEF[425] = new Array("OddsId_425", "Odds_425_H", "Odds_425_A");
MultiSportODDS_DEF[426] = new Array("OddsId_426", "Odds_426_H1", "Odds_426_H2UP", "Odds_426_D", "Odds_426_A1", "Odds_426_A2UP", "Odds_426_NG");
MultiSportODDS_DEF[429] = new Array("OddsId_429", "Odds_429_0", "Odds_429_1", "Odds_429_2", "Odds_429_3OVER");
MultiSportODDS_DEF[445] = new Array("OddsId_445", "Odds_445_YY", "Odds_445_YN", "Odds_445_NY", "Odds_445_NN");
MultiSportODDS_DEF[446] = new Array("OddsId_446", "Odds_446_YY", "Odds_446_YN", "Odds_446_NY", "Odds_446_NN");
MultiSportODDS_DEF[447] = new Array("OddsId_447", "Odds_447_YY", "Odds_447_YN", "Odds_447_NY", "Odds_447_NN");
MultiSportODDS_DEF[448] = new Array("OddsId_448", "Odds_448_H", "Odds_448_A", "Odds_448_NG");
MultiSportODDS_DEF[449] = new Array("OddsId_449", "Goal_449", "Odds_449_1XO", "Odds_449_1XU", "Odds_449_12O", "Odds_449_12U", "Odds_449_2XO", "Odds_449_2XU");
MultiSportODDS_DEF[450] = new Array("OddsId_450", "Goal_450", "Odds_450_OO", "Odds_450_OU", "Odds_450_EO", "Odds_450_EU");
MultiSportODDS_DEF[451] = new Array("OddsId_451", "Odds_451_Y1X", "Odds_451_Y12", "Odds_451_Y2X", "Odds_451_N1X", "Odds_451_N12", "Odds_451_N2X");
MultiSportODDS_DEF[452] = new Array("OddsId_452", "Odds_452_1H", "Odds_452_2H");
MultiSportODDS_DEF[453] = new Array("OddsId_453", "Odds_453_1", "Odds_453_X", "Odds_453_2", "Odds_453_hdp1", "Odds_453_hdpx", "Odds_453_hdp2");
MultiSportODDS_DEF[454] = new Array("OddsId_454", "Odds_454_1XH", "Odds_454_12H", "Odds_454_2XH", "Odds_454_1XA", "Odds_454_12A", "Odds_454_2XA", "Odds_454_NG");
MultiSportODDS_DEF[455] = new Array("OddsId_455", "Odds_455_110", "Odds_455_1120", "Odds_455_2130", "Odds_455_3140", "Odds_455_4150", "Odds_455_5160", "Odds_455_6170", "Odds_455_7180", "Odds_455_8190", "Odds_455_NG");
MultiSportODDS_DEF[456] = new Array("OddsId_456", "Odds_456_YH", "Odds_456_YA", "Odds_456_YD", "Odds_456_NH", "Odds_456_NA", "Odds_456_ND");
MultiSportODDS_DEF[457] = new Array("OddsId_457", "Goal_457", "Odds_457_YO", "Odds_457_YU", "Odds_457_NO", "Odds_457_NU");
MultiSportODDS_DEF[458] = new Array("OddsId_458", "Odds_458_1", "Odds_458_X", "Odds_458_2");
MultiSportODDS_DEF[459] = new Array("OddsId_459", "Odds_459_1", "Odds_459_X", "Odds_459_2");
MultiSportODDS_DEF[460] = new Array("OddsId_460", "Odds_460_H", "Odds_460_A");
MultiSportODDS_DEF[461] = new Array("OddsId_461", "Goal_461", "Odds_461_O", "Odds_461_U");
MultiSportODDS_DEF[462] = new Array("OddsId_462", "Goal_462", "Odds_462_O", "Odds_462_U");
MultiSportODDS_DEF[463] = new Array("OddsId_463", "Goal_463", "Odds_463_O", "Odds_463_U");
MultiSportODDS_DEF[464] = new Array("OddsId_464", "Goal_464", "Odds_464_O", "Odds_464_U");

//Fast Markets
MultiSportODDS_DEF[221] = new Array("OddsId_221", "Value_221", "Odds_221_01", "Odds_221_02", "Odds_221_03", "Odds_221_04", "Odds_221_05");
MultiSportODDS_DEF[222] = new Array("OddsId_222", "Value_222", "Odds_222_01", "Odds_222_10", "Odds_222_02", "Odds_222_20", "Odds_222_13");
MultiSportODDS_DEF[223] = new Array("OddsId_223", "Value_223", "Odds_223_00", "Odds_223_01", "Odds_223_02", "Odds_223_03", "Odds_223_04", "Odds_223_05");
MultiSportODDS_DEF[224] = new Array("OddsId_224", "Value_224", "Odds_224_00", "Odds_224_01", "Odds_224_02", "Odds_224_12", "Odds_224_13");
MultiSportODDS_DEF[225] = new Array("OddsId_225", "Value_225", "Odds_225_00", "Odds_225_01");

//Virtual Sports
//1201,1203,1204,1205,1206,1224 (Virtual Soccer)
MultiSportODDS_DEF[1201] = new Array("OddsId_1201", "Value_1201", "Odds_1201_H", "Odds_1201_A", "FavorF");
MultiSportODDS_DEF[1203] = new Array("OddsId_1203", "Goal_1203", "Odds_1203_O", "Odds_1203_U");
MultiSportODDS_DEF[1204] = new Array("OddsId_1204", "Odds_1204_00", "Odds_1204_01", "Odds_1204_02", "Odds_1204_03", "Odds_1204_04", "Odds_1204_10", "Odds_1204_11", "Odds_1204_12", "Odds_1204_13", "Odds_1204_20", "Odds_1204_21", "Odds_1204_22", "Odds_1204_30", "Odds_1204_31", "Odds_1204_40");
MultiSportODDS_DEF[1205] = new Array("OddsId_1205", "Odds_1205_1", "Odds_1205_X", "Odds_1205_2");
MultiSportODDS_DEF[1206] = new Array("OddsId_1206", "Odds_1206_0", "Odds_1206_1", "Odds_1206_2", "Odds_1206_3", "Odds_1206_4");
MultiSportODDS_DEF[1224] = new Array("OddsId_1224", "Odds_1224_1X", "Odds_1224_12", "Odds_1224_2X");
//Virtual Sports
//1220,1235,1236 (Virtual Tennis)
MultiSportODDS_DEF[1220] = new Array("OddsId_1220", "Odds_1220_H", "Odds_1220_A");
MultiSportODDS_DEF[1235] = new Array("OddsId_1235", "Odds_1235_01", "Odds_1235_02", "Odds_1235_03", "Odds_1235_04", "Odds_1235_10", "Odds_1235_20", "Odds_1235_30", "Odds_1235_40");
MultiSportODDS_DEF[1236] = new Array("OddsId_1236", "Odds_1236_0", "Odds_1236_1", "Odds_1236_2", "Odds_1236_3", "Odds_1236_4", "Odds_1236_5");
//Tennis Handicap
MultiSportODDS_DEF[1326] = new Array("OddsId", "Value", "Odds_0", "Odds_1", "FavorF", "Resourceid");
//Tennis 2-way
MultiSportODDS_DEF[1304] = new Array("OddsId", "Goal", "Odds_0", "Odds_1", "Resourceid");
MultiSportODDS_DEF[1310] = MultiSportODDS_DEF[1304];
MultiSportODDS_DEF[1323] = MultiSportODDS_DEF[1304];
MultiSportODDS_DEF[1329] = MultiSportODDS_DEF[1304];
//Tennis Odd/Even
MultiSportODDS_DEF[1318] = new Array("OddsId", "Odds_0", "Odds_1", "Resourceid");
MultiSportODDS_DEF[1331] = MultiSportODDS_DEF[1318];
//Tennis 3-way
MultiSportODDS_DEF[1307] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "hdp1", "hdpx", "hdp2", "Resourceid");
MultiSportODDS_DEF[1309] = MultiSportODDS_DEF[1307];
MultiSportODDS_DEF[1313] = MultiSportODDS_DEF[1307];
MultiSportODDS_DEF[1330] = MultiSportODDS_DEF[1307];
//Tennis Set x Games y & y+1 Points
MultiSportODDS_DEF[1334] = new Array("OddsId", "Goal", "Odds_0", "Odds_1", "Odds_2", "Resourceid");
//Tennis Set x Game y Total Points Exact
MultiSportODDS_DEF[1328] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Resourceid");
//Tennis Match Correct Score
MultiSportODDS_DEF[1302] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Odds_4", "Odds_5", "Odds_6", "Odds_7", "Odds_8", "Odds_9", "Resourceid");
//Tennis Set x Correct Score
MultiSportODDS_DEF[1317] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Odds_4", "Odds_5", "Odds_6", "Odds_7", "Odds_8", "Odds_9", "Odds_10", "Odds_11", "Odds_12", "Odds_13", "Resourceid");
//Tennis Set x Score after 2 Games
MultiSportODDS_DEF[1320] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Resourceid");
//Tennis Set x Score after 4 Games
MultiSportODDS_DEF[1321] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Odds_4", "Resourceid");
//Tennis Set x Score after 6 Games
MultiSportODDS_DEF[1322] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Odds_4", "Odds_5", "Odds_6", "Resourceid");
//Tennis Set x Game y Correct Score
MultiSportODDS_DEF[1325] = new Array("OddsId", "Odds_0", "Odds_1", "Odds_2", "Odds_3", "Odds_4", "Odds_5", "Odds_6", "Odds_7", "Resourceid");
//Tennis Winner(MoneyLine)
MultiSportODDS_DEF[1314] = new Array("OddsId", "Odds_0", "Odds_1", "Resourceid");
MultiSportODDS_DEF[1319] = MultiSportODDS_DEF[1314];
MultiSportODDS_DEF[1324] = MultiSportODDS_DEF[1314];
MultiSportODDS_DEF[1327] = MultiSportODDS_DEF[1314];
MultiSportODDS_DEF[1332] = MultiSportODDS_DEF[1314];
//Tennis 1X2
MultiSportODDS_DEF[1315] = MultiSportODDS_DEF[1320];
MultiSportODDS_DEF[1333] = MultiSportODDS_DEF[1320];
//New Cricket Match Winner
MultiSportODDS_DEF[501] = new Array("OddsId_501", "Odds_501_H", "Odds_501_A", "Odds_501_CS10", "Odds_501_CS20");
MultiSportODDS_DEF[502] = new Array("OddsId_502", "Odds_502_1", "Odds_502_X", "Odds_502_2");
//Basketball all in one
MultiSportODDS_DEF[601] = new Array("OddsId_601", "Odds_601_H1-2", "Odds_601_H3-6", "Odds_601_H7-9", "Odds_601_H10-13", "Odds_601_H14-16", "Odds_601_H17-20", "Odds_601_H21up",
                                    "Odds_601_A1-2", "Odds_601_A3-6", "Odds_601_A7-9", "Odds_601_A10-13", "Odds_601_A14-16", "Odds_601_A17-20", "Odds_601_A21up");
MultiSportODDS_DEF[602] = new Array("OddsId_602", "Odds_602_H1-5", "Odds_602_H6-10", "Odds_602_H11-15", "Odds_602_H16-20", "Odds_602_H21-25", "Odds_602_H26up",
                                    "Odds_602_A1-5", "Odds_602_A6-10", "Odds_602_A11-15", "Odds_602_A16-20", "Odds_602_A21-25", "Odds_602_A26up");
MultiSportODDS_DEF[603] = new Array("OddsId_603", "Odds_603_H", "Odds_603_A");
MultiSportODDS_DEF[604] = new Array("OddsId_604", "Odds_604_H", "Odds_604_A");
MultiSportODDS_DEF[605] = new Array("OddsId_605", "Odds_605_H", "Odds_605_A");
MultiSportODDS_DEF[606] = new Array("OddsId_606", "Odds_606_H", "Odds_606_A", "Resourceid");
MultiSportODDS_DEF[607] = new Array("OddsId_607", "Odds_607_H", "Odds_607_A", "Resourceid");
MultiSportODDS_DEF[608] = new Array("OddsId_608", "Odds_608_H1-5", "Odds_608_H6-10", "Odds_608_H11-15", "Odds_608_H16-20", "Odds_608_H21-25", "Odds_608_H26up", "Odds_608_D",
                                    "Odds_608_A1-5", "Odds_608_A6-10", "Odds_608_A11-15", "Odds_608_A16-20", "Odds_608_A21-25", "Odds_608_A26up");
MultiSportODDS_DEF[609] = new Array("OddsId_609", "Value_609", "Odds_609_H", "Odds_609_A", "FavorF");
MultiSportODDS_DEF[610] = new Array("OddsId_610", "Goal_610", "Odds_610_O", "Odds_610_U");
MultiSportODDS_DEF[611] = new Array("OddsId_611", "Odds_611_O", "Odds_611_E");
MultiSportODDS_DEF[612] = new Array("OddsId_612", "Odds_612_H", "Odds_612_A", "Resourceid");
MultiSportODDS_DEF[613] = new Array("OddsId_613", "Odds_613_H", "Odds_613_A", "Resourceid");
MultiSportODDS_DEF[614] = new Array("OddsId_614", "Odds_614_H1-4", "Odds_614_H5-8", "Odds_614_H9up", "Odds_614_D",
                                    "Odds_614_A1-4", "Odds_614_A5-8", "Odds_614_A9up");
MultiSportODDS_DEF[615] = new Array("OddsId_615", "Goal_615", "Odds_615_O", "Odds_615_U", "Resourceid");
MultiSportODDS_DEF[616] = new Array("OddsId_616", "Goal_616", "Odds_616_O", "Odds_616_U", "Resourceid");
MultiSportODDS_DEF[617] = new Array("OddsId_617", "Odds_617_H", "Odds_617_A", "Resourceid");

// soccer more
var mMultiSportODDS_DEF = new Array();
mMultiSportODDS_DEF["B1_2_3_5"] = COMMON_DEF[5].concat(MultiSportODDS_DEF[1]).concat(MultiSportODDS_DEF[2]).concat(MultiSportODDS_DEF[3]).concat(MultiSportODDS_DEF[5]);
mMultiSportODDS_DEF["B7_12_8_15"] = COMMON_DEF[5].concat(MultiSportODDS_DEF[7]).concat(MultiSportODDS_DEF[12]).concat(MultiSportODDS_DEF[8]).concat(MultiSportODDS_DEF[15]);


mMultiSportODDS_DEF["B2"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[2]);
mMultiSportODDS_DEF["B4"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[4]);
mMultiSportODDS_DEF["B5"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[5]);
mMultiSportODDS_DEF["B6"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[6]);
mMultiSportODDS_DEF["B11"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[11]);
mMultiSportODDS_DEF["B12"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[12]);
mMultiSportODDS_DEF["B13"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[13]);
mMultiSportODDS_DEF["B14"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[14]);
mMultiSportODDS_DEF["B15"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[15]);
mMultiSportODDS_DEF["B16"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[16]);
mMultiSportODDS_DEF["B17"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[17]);
mMultiSportODDS_DEF["B18"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[18]);
mMultiSportODDS_DEF["B22"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[22]);
mMultiSportODDS_DEF["B24"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[24]);
mMultiSportODDS_DEF["B25"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[25]);
mMultiSportODDS_DEF["B26"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[26]);
mMultiSportODDS_DEF["B27"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[27]);
mMultiSportODDS_DEF["B28"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[28]);
mMultiSportODDS_DEF["B30"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[30]);
mMultiSportODDS_DEF["B121"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[121]);
mMultiSportODDS_DEF["B122"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[122]);
mMultiSportODDS_DEF["B123"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[123]);
mMultiSportODDS_DEF["B126"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[126]);
mMultiSportODDS_DEF["B127"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[127]);
mMultiSportODDS_DEF["B128"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[128]);
mMultiSportODDS_DEF["B133"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[133]);
mMultiSportODDS_DEF["B134"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[134]);
mMultiSportODDS_DEF["B135"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[135]);
mMultiSportODDS_DEF["B140"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[140]);
mMultiSportODDS_DEF["B141"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[141]);
mMultiSportODDS_DEF["B142"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[142]);
mMultiSportODDS_DEF["B143"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[143]);
mMultiSportODDS_DEF["B144"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[144]);
mMultiSportODDS_DEF["B145"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[145]);
mMultiSportODDS_DEF["B146"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[146]);
mMultiSportODDS_DEF["B147"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[147]);
mMultiSportODDS_DEF["B148"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[148]);
mMultiSportODDS_DEF["B149"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[149]);
mMultiSportODDS_DEF["B150"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[150]);
mMultiSportODDS_DEF["B151"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[151]);
mMultiSportODDS_DEF["B152"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[152]);
mMultiSportODDS_DEF["B158"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[158]);
mMultiSportODDS_DEF["B159"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[159]);
mMultiSportODDS_DEF["B161"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[161]);
mMultiSportODDS_DEF["B162"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[162]);
mMultiSportODDS_DEF["B164"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[164]);
mMultiSportODDS_DEF["B165"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[165]);
mMultiSportODDS_DEF["B166"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[166]);
mMultiSportODDS_DEF["B167"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[167]);
mMultiSportODDS_DEF["B168"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[168]);
mMultiSportODDS_DEF["B169"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[169]);
mMultiSportODDS_DEF["B170"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[170]);
mMultiSportODDS_DEF["B171"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[171]);
mMultiSportODDS_DEF["B172"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[172]);
mMultiSportODDS_DEF["B173"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[173]);
mMultiSportODDS_DEF["B174"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[174]);
mMultiSportODDS_DEF["B175"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[175]);
mMultiSportODDS_DEF["B176"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[176]);
mMultiSportODDS_DEF["B177"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[177]);
mMultiSportODDS_DEF["B179"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[179]);
mMultiSportODDS_DEF["B180"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[180]);
mMultiSportODDS_DEF["B181"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[181]);
mMultiSportODDS_DEF["B182"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[182]);
mMultiSportODDS_DEF["B184"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[184]);
mMultiSportODDS_DEF["B185"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[185]);
mMultiSportODDS_DEF["B186"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[186]);
mMultiSportODDS_DEF["B187"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[187]);
mMultiSportODDS_DEF["B188"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[188]);
mMultiSportODDS_DEF["B189"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[189]);
mMultiSportODDS_DEF["B190"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[190]);
mMultiSportODDS_DEF["B191"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[191]);
mMultiSportODDS_DEF["B192"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[192]);
mMultiSportODDS_DEF["B193"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[193]);
mMultiSportODDS_DEF["B194"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[194]);
mMultiSportODDS_DEF["B195"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[195]);
mMultiSportODDS_DEF["B196"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[196]);
mMultiSportODDS_DEF["B197"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[197]);
mMultiSportODDS_DEF["B198"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[198]);
mMultiSportODDS_DEF["B200"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[200]);
mMultiSportODDS_DEF["B201"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[201]);
mMultiSportODDS_DEF["B202"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[202]);
mMultiSportODDS_DEF["B203"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[203]);
mMultiSportODDS_DEF["B204"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[204]);
mMultiSportODDS_DEF["B205"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[205]);
mMultiSportODDS_DEF["B206"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[206]);
mMultiSportODDS_DEF["B207"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[207]);
mMultiSportODDS_DEF["B208"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[208]);
mMultiSportODDS_DEF["B209"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[209]);
mMultiSportODDS_DEF["B210"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[210]);
mMultiSportODDS_DEF["B211"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[211]);
mMultiSportODDS_DEF["B212"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[212]);
mMultiSportODDS_DEF["B213"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[213]);
mMultiSportODDS_DEF["B214"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[214]);
mMultiSportODDS_DEF["B215"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[215]);
mMultiSportODDS_DEF["B216"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[216]);
mMultiSportODDS_DEF["B217"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[217]);

mMultiSportODDS_DEF["B221"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[221]);
mMultiSportODDS_DEF["B222"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[222]);
mMultiSportODDS_DEF["B223"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[223]);
mMultiSportODDS_DEF["B224"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[224]);
mMultiSportODDS_DEF["B225"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[225]);

mMultiSportODDS_DEF["B401"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[401]);
mMultiSportODDS_DEF["B402"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[402]);
mMultiSportODDS_DEF["B403"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[403]);
mMultiSportODDS_DEF["B404"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[404]);
mMultiSportODDS_DEF["B405"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[405]);
mMultiSportODDS_DEF["B412"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[412]);
mMultiSportODDS_DEF["B413"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[413]);
mMultiSportODDS_DEF["B414"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[414]);

mMultiSportODDS_DEF["B416"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[416]);
mMultiSportODDS_DEF["B417"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[417]);
mMultiSportODDS_DEF["B418"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[418]);
mMultiSportODDS_DEF["B419"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[419]);
mMultiSportODDS_DEF["B420"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[420]);
mMultiSportODDS_DEF["B421"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[421]);
mMultiSportODDS_DEF["B422"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[422]);
mMultiSportODDS_DEF["B423"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[423]);
mMultiSportODDS_DEF["B424"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[424]);
mMultiSportODDS_DEF["B425"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[425]);
mMultiSportODDS_DEF["B426"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[426]);
mMultiSportODDS_DEF["B429"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[429]);
mMultiSportODDS_DEF["B445"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[445]);
mMultiSportODDS_DEF["B446"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[446]);
mMultiSportODDS_DEF["B447"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[447]);
mMultiSportODDS_DEF["B448"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[448]);
mMultiSportODDS_DEF["B449"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[449]);
mMultiSportODDS_DEF["B450"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[450]);
mMultiSportODDS_DEF["B451"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[451]);
mMultiSportODDS_DEF["B452"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[452]);
mMultiSportODDS_DEF["B453"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[453]);
mMultiSportODDS_DEF["B454"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[454]);
mMultiSportODDS_DEF["B455"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[455]);
mMultiSportODDS_DEF["B456"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[456]);
mMultiSportODDS_DEF["B457"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[457]);
mMultiSportODDS_DEF["B458"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[458]);
mMultiSportODDS_DEF["B459"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[459]);
mMultiSportODDS_DEF["B460"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[460]);
mMultiSportODDS_DEF["B461"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[461]);
mMultiSportODDS_DEF["B462"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[462]);
mMultiSportODDS_DEF["B463"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[463]);
mMultiSportODDS_DEF["B464"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[464]);

mMultiSportODDS_DEF["B20"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[20]);
mMultiSportODDS_DEF["B21"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[21]);
mMultiSportODDS_DEF["B601"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[601]);
mMultiSportODDS_DEF["B602"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[602]);
mMultiSportODDS_DEF["B603"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[603]);
mMultiSportODDS_DEF["B604"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[604]);
mMultiSportODDS_DEF["B605"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[605]);
mMultiSportODDS_DEF["B606"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[606]);
mMultiSportODDS_DEF["B607"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[607]);
mMultiSportODDS_DEF["B608"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[608]);
mMultiSportODDS_DEF["B609"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[609]);
mMultiSportODDS_DEF["B610"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[610]);
mMultiSportODDS_DEF["B611"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[611]);
mMultiSportODDS_DEF["B612"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[612]);
mMultiSportODDS_DEF["B613"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[613]);
mMultiSportODDS_DEF["B614"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[614]);
mMultiSportODDS_DEF["B615"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[615]);
mMultiSportODDS_DEF["B616"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[616]);
mMultiSportODDS_DEF["B617"] = COMMON_DEF[4].concat(MultiSportODDS_DEF[617]);

var LIVESCORE_DEF = new Array();
LIVESCORE_DEF[2] = new Array("GS", "LLP", "H1Q", "H2Q", "H3Q", "H4Q", "A1Q", "A2Q", "A3Q", "A4Q", "HOT", "AOT", "HIDE", "HTG", "ATG");
LIVESCORE_DEF[3] = new Array("GS", "LLP", "H1Q", "H2Q", "H3Q", "H4Q", "A1Q", "A2Q", "A3Q", "A4Q", "HOT", "AOT", "BALLON", "DOWN", "TOGO", "HIDE", "HTG", "ATG");
LIVESCORE_DEF[4] = new Array("GS", "LLP", "H1S", "H2S", "H3S", "A1S", "A2S", "A3S", "HOT", "AOT", "HIDE", "HTG", "ATG", "PP", "HPP", "APP");
LIVESCORE_DEF[7] = new Array("GS", "HFM", "AFM", "CFM", "HPT", "APT", "HLS", "TRN");
LIVESCORE_DEF[5] = new Array("GS", "LLP", "H1S", "H2S", "H3S", "H4S", "H5S", "A1S", "A2S", "A3S", "A4S", "A5S", "HPT", "APT", "HS", "AS", "SERVING", "GT", "HIDE", "HTG", "ATG", "INJ");
LIVESCORE_DEF[8] = new Array("GS", "LLP", "H1S", "H2S", "H3S", "H4S", "H5S", "H6S", "H7S", "H8S", "H9S", "A1S", "A2S", "A3S", "A4S", "A5S", "A6S", "A7S", "A8S", "A9S", "HOT", "AOT", "Battle", "B1", "B2", "B3", "Out", "HIDE", "HRUNS", "ARUNS");
LIVESCORE_DEF[26] = new Array("GS", "LLP");
LIVESCORE_DEF[28] = new Array("GS", "LLP");

//oddskeeper using
var LIVE_SCORE_HEAD_DEF = new Array("MUID");
var LIVE_SCORE_DEF = new Array();
LIVE_SCORE_DEF[2] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[2]);
LIVE_SCORE_DEF[3] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[3]);
LIVE_SCORE_DEF[4] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[4]);
LIVE_SCORE_DEF[5] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[5]);
LIVE_SCORE_DEF[6] = LIVE_SCORE_DEF[5];
LIVE_SCORE_DEF[7] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[7]);
LIVE_SCORE_DEF[8] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[8]);
LIVE_SCORE_DEF[9] = LIVE_SCORE_DEF[5];
LIVE_SCORE_DEF[26] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[26]);
LIVE_SCORE_DEF[28] = LIVE_SCORE_HEAD_DEF.concat(LIVESCORE_DEF[28]);

//oddskeeper using
var ODDS_HEAD_DEF = new Array("MUID", "BetType");
var ODDS_DEF = new Array(); // update odds data defination
ODDS_DEF[0] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[0]); // Outright
ODDS_DEF[1] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[1]);
ODDS_DEF[2] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[2]);
ODDS_DEF[3] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[3]);
ODDS_DEF[4] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[4]);
ODDS_DEF[5] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[5]);
ODDS_DEF[6] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[6]);
ODDS_DEF[7] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[7]);
ODDS_DEF[8] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[8]);
ODDS_DEF[12] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[12]);
ODDS_DEF[14] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[14]);
ODDS_DEF[15] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[15]);
ODDS_DEF[16] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[16]);
ODDS_DEF[20] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[20]);
ODDS_DEF[21] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[21]);
//ODDS_DEF[22] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[22]);
ODDS_DEF[30] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[30]);
ODDS_DEF[81] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[81]);
ODDS_DEF[82] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[82]);
ODDS_DEF[83] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[83]);
ODDS_DEF[84] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[84]);
ODDS_DEF[85] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[85]);
ODDS_DEF[86] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[86]);
ODDS_DEF[87] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[87]);
ODDS_DEF[88] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[88]);
ODDS_DEF[89] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[89]);
ODDS_DEF[901] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[901]);
ODDS_DEF[902] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[902]);
ODDS_DEF[903] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[903]);
ODDS_DEF[904] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[904]);
ODDS_DEF[905] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[905]);
ODDS_DEF[126] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[126]);
ODDS_DEF[127] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[127]);
ODDS_DEF[128] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[128]);
ODDS_DEF[133] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[133]);
ODDS_DEF[134] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[134]);
ODDS_DEF[135] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[135]);
ODDS_DEF[140] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[140]);
ODDS_DEF[141] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[141]);
ODDS_DEF[142] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[142]);
ODDS_DEF[143] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[143]);
ODDS_DEF[144] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[144]);
ODDS_DEF[145] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[145]);
ODDS_DEF[146] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[146]);
ODDS_DEF[147] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[147]);
ODDS_DEF[148] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[148]);
ODDS_DEF[149] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[149]);
ODDS_DEF[150] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[150]);
ODDS_DEF[151] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[151]);
ODDS_DEF[152] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[152]);
ODDS_DEF[153] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[153]);
ODDS_DEF[401] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[401]);
ODDS_DEF[402] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[402]);
ODDS_DEF[403] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[403]);
ODDS_DEF[404] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[404]);
ODDS_DEF[405] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[405]);
ODDS_DEF[412] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[412]);
ODDS_DEF[413] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[413]);
ODDS_DEF[414] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[414]);

ODDS_DEF[416] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[416]);
ODDS_DEF[417] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[417]);
ODDS_DEF[418] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[418]);
ODDS_DEF[419] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[419]);
ODDS_DEF[420] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[420]);
ODDS_DEF[421] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[421]);
ODDS_DEF[422] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[422]);
ODDS_DEF[423] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[423]);
ODDS_DEF[424] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[424]);
ODDS_DEF[425] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[425]);
ODDS_DEF[426] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[426]);
ODDS_DEF[429] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[429]);
ODDS_DEF[445] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[445]);
ODDS_DEF[446] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[446]);
ODDS_DEF[447] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[447]);
ODDS_DEF[448] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[448]);
ODDS_DEF[449] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[449]);
ODDS_DEF[450] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[450]);
ODDS_DEF[451] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[451]);
ODDS_DEF[452] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[452]);
ODDS_DEF[453] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[453]);
ODDS_DEF[454] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[454]);
ODDS_DEF[455] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[455]);
ODDS_DEF[456] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[456]);
ODDS_DEF[457] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[457]);
ODDS_DEF[458] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[458]);
ODDS_DEF[459] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[459]);
ODDS_DEF[460] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[460]);
ODDS_DEF[461] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[461]);
ODDS_DEF[462] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[462]);
ODDS_DEF[463] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[463]);
ODDS_DEF[464] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[464]);

ODDS_DEF[501] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[501]);

ODDS_DEF[601] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[601]);
ODDS_DEF[602] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[602]);
ODDS_DEF[603] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[603]);
ODDS_DEF[604] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[604]);
ODDS_DEF[605] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[605]);
ODDS_DEF[606] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[606]);
ODDS_DEF[607] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[607]);
ODDS_DEF[608] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[608]);
ODDS_DEF[609] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[609]);
ODDS_DEF[610] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[610]);
ODDS_DEF[611] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[611]);
ODDS_DEF[612] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[612]);
ODDS_DEF[613] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[613]);
ODDS_DEF[614] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[614]);
ODDS_DEF[615] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[615]);
ODDS_DEF[616] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[616]);
ODDS_DEF[617] = ODDS_HEAD_DEF.concat(MultiSportODDS_DEF[617]);

/*
 * BetType Id Defination Block
 */
var ARR_BETYPE_DEF = new Array();
ARR_BETYPE_DEF["1"] = new Array(1, 3, 5, 7, 8, 15);
ARR_BETYPE_DEF["2"] = new Array(1, 2, 3, 7, 8, 12, 20, 21);
ARR_BETYPE_DEF["3"] = new Array(1, 2, 3, 7, 8, 12);
ARR_BETYPE_DEF["26"] = ARR_BETYPE_DEF["3"];
ARR_BETYPE_DEF["32"] = ARR_BETYPE_DEF["3"];
ARR_BETYPE_DEF["4"] = new Array(1, 2, 3, 20);
ARR_BETYPE_DEF["5"] = new Array(1, 2, 3, 20, 153);
//ARR_BETYPE_DEF["5"] = new Array(1,2,3,20);
ARR_BETYPE_DEF["6"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["7"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["8"] = new Array(1, 3, 7, 8, 20, 21);
ARR_BETYPE_DEF["9"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["10"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["11"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["12"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["13"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["14"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["15"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["16"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["17"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["18"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["19"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["20"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["21"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["22"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["23"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["24"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["25"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["28"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["29"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["30"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["31"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["33"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["34"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["35"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["36"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["37"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["38"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["39"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["40"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["41"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["42"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["43"] = new Array(1, 2, 3, 20);
ARR_BETYPE_DEF["44"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["99"] = ARR_BETYPE_DEF["4"];
ARR_BETYPE_DEF["27"] = new Array(1, 2, 3, 5, 20);
ARR_BETYPE_DEF["154"] = new Array('20');
ARR_BETYPE_DEF["161"] = new Array(85, 86, 87, 88, 89, 901, 902, 903, 904, 905);
ARR_BETYPE_DEF["161d"] = new Array(81, 82, 83, 84, 85, 86, 88);
ARR_BETYPE_DEF["CS"] = new Array(4, 30, 405, 413, 414);
ARR_BETYPE_DEF["50"] = new Array(1, 2, 3, 5, 501, 502);

function MargeOddsArray(SportType) {
    var TempArr = new Array();
    for (var i = 0; i < ARR_BETYPE_DEF[SportType].length; i++) {
        TempArr = TempArr.concat(MultiSportODDS_DEF[ARR_BETYPE_DEF[SportType][i]]);
    }
    return TempArr;
}
//LIVE ARRAY
var ARR_FIELDS_DEF = new Array();
// Soccer Fields
ARR_FIELDS_DEF['1'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[1]).concat(ExtFIELDS_DEF[1]).concat(COMMON_DEF[3]).concat(COMMON_DEF[1]).concat(MargeOddsArray("1"));
// Baseketball Fields
ARR_FIELDS_DEF['2'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[2]).concat(COMMON_DEF[1]).concat(MargeOddsArray("2")).concat(LIVESCORE_DEF[2]);
ARR_FIELDS_DEF['3'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("3")).concat(LIVESCORE_DEF[3]);
ARR_FIELDS_DEF['26'] = ARR_FIELDS_DEF['3'];
ARR_FIELDS_DEF['32'] = ARR_FIELDS_DEF['3'];
// Tennis Fields
ARR_FIELDS_DEF['10'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("4"));
ARR_FIELDS_DEF['7'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("7")).concat(LIVESCORE_DEF[7]);
ARR_FIELDS_DEF['4'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("4")).concat(LIVESCORE_DEF[4]);
ARR_FIELDS_DEF['5'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[5]).concat(COMMON_DEF[1]).concat(MargeOddsArray("5")).concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF['6'] = ARR_FIELDS_DEF['10'].concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF['9'] = ARR_FIELDS_DEF['6'];
ARR_FIELDS_DEF['11'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['12'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['13'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['14'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['15'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['16'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['17'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['18'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['19'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['20'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['21'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['22'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['23'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['24'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['25'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['28'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['29'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['30'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['31'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['33'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['34'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['35'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['36'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['37'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['38'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['39'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['40'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['41'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['42'] = ARR_FIELDS_DEF['10'];
ARR_FIELDS_DEF['43'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("43"));
ARR_FIELDS_DEF['44'] = ARR_FIELDS_DEF['10'];
//New Cricket Fields
ARR_FIELDS_DEF['50'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("50"));
ARR_FIELDS_DEF['99'] = ARR_FIELDS_DEF['10'];
// Baseball Fields
ARR_FIELDS_DEF['8'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[8]).concat(COMMON_DEF[1]).concat(MargeOddsArray("8")).concat(LIVESCORE_DEF[8]);
// Cricket Fields
ARR_FIELDS_DEF['27'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[1]).concat(MargeOddsArray("27"));
// Bingo Fields
ARR_FIELDS_DEF['161'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[161]).concat(COMMON_DEF[1]).concat(MargeOddsArray("161"));

//PARLAY ARRAY
var ARR_FIELDS_DEF2 = new Array();
// Soccer Fields
//ARR_FIELDS_DEF2['1'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[1]).concat(ExtFIELDS_DEF[1]).concat(COMMON_DEF[2]).concat(MargeOddsArray("1"));
ARR_FIELDS_DEF2['1'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[1]).concat(COMMON_DEF[2]).concat(MargeOddsArray("1"));
// Baseketball Fields
ARR_FIELDS_DEF2['2'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[2]).concat(COMMON_DEF[2]).concat(MargeOddsArray("2")).concat(LIVESCORE_DEF[2]);
ARR_FIELDS_DEF2['3'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("3")).concat(LIVESCORE_DEF[3]);
ARR_FIELDS_DEF2['26'] = ARR_FIELDS_DEF2['3'];
ARR_FIELDS_DEF2['32'] = ARR_FIELDS_DEF2['3'];
// Tennis Fields
ARR_FIELDS_DEF2['10'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("4"));
ARR_FIELDS_DEF2['7'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("7")).concat(LIVESCORE_DEF[7]);
ARR_FIELDS_DEF2['4'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("4")).concat(LIVESCORE_DEF[4]);
ARR_FIELDS_DEF2['5'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[5]).concat(COMMON_DEF[2]).concat(MargeOddsArray("5")).concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF2['6'] = ARR_FIELDS_DEF2['10'].concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF2['9'] = ARR_FIELDS_DEF2['6'];
ARR_FIELDS_DEF2['11'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['12'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['13'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['14'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['15'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['16'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['17'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['18'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['19'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['20'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['21'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['22'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['23'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['24'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['25'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['28'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['29'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['30'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['31'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['33'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['34'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['35'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['36'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['37'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['38'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['39'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['40'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['41'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['42'] = ARR_FIELDS_DEF2['10'];
ARR_FIELDS_DEF2['43'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("43"));
//New Cricket Fields
ARR_FIELDS_DEF2['50'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("50"));
ARR_FIELDS_DEF2['99'] = ARR_FIELDS_DEF2['10'];
// Baseball Fields
ARR_FIELDS_DEF2['8'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[8]).concat(COMMON_DEF[2]).concat(MargeOddsArray("8")).concat(LIVESCORE_DEF[8]);
// Cricket Fields
ARR_FIELDS_DEF2['27'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[2]).concat(MargeOddsArray("27"));
// Bingo Fields
ARR_FIELDS_DEF2['161'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[161]).concat(COMMON_DEF[2]).concat(MargeOddsArray("161"));


//DEADBALL ARRAY
var ARR_FIELDS_DEF1 = new Array();
// Soccer Fields
ARR_FIELDS_DEF1['1'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[1]).concat(ExtFIELDS_DEF[1]).concat(COMMON_DEF[3]).concat(MargeOddsArray("1"));
// Baseketball Fields
ARR_FIELDS_DEF1['2'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[2]).concat(MargeOddsArray("2")).concat(LIVESCORE_DEF[2]);
ARR_FIELDS_DEF1['3'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("3")).concat(LIVESCORE_DEF[3]);
ARR_FIELDS_DEF1['26'] = ARR_FIELDS_DEF1['3'];
ARR_FIELDS_DEF1['32'] = ARR_FIELDS_DEF1['3'];
// Tennis Fields
ARR_FIELDS_DEF1['10'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("4"));
ARR_FIELDS_DEF1['7'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("7")).concat(LIVESCORE_DEF[7]);
ARR_FIELDS_DEF1['4'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("4")).concat(LIVESCORE_DEF[4]);
ARR_FIELDS_DEF1['5'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[5]).concat(MargeOddsArray("5")).concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF1['6'] = ARR_FIELDS_DEF1['10'].concat(LIVESCORE_DEF[5]);
ARR_FIELDS_DEF1['9'] = ARR_FIELDS_DEF1['6'];
ARR_FIELDS_DEF1['11'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['12'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['13'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['14'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['15'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['16'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['17'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['18'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['19'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['20'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['21'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['22'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['23'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['24'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['25'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['28'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['29'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['30'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['31'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['33'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['34'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['35'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['36'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['37'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['38'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['39'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['40'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['41'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['42'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['43'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("43"));
ARR_FIELDS_DEF1['44'] = ARR_FIELDS_DEF1['10'];
ARR_FIELDS_DEF1['50'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("50"));
ARR_FIELDS_DEF1['99'] = ARR_FIELDS_DEF1['10'];
//Horse Racing Fix Odds
ARR_FIELDS_DEF1['154'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("154"));
// Baseball Fields
ARR_FIELDS_DEF1['8'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[8]).concat(MargeOddsArray("8")).concat(LIVESCORE_DEF[8]);
// Cricket Fields
ARR_FIELDS_DEF1['27'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MargeOddsArray("27"));
// Bingo Fields
ARR_FIELDS_DEF1['161'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[161]).concat(MargeOddsArray("161"));
ARR_FIELDS_DEF1['161d'] = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(FIELDS_DEF[161]).concat(MargeOddsArray("161d"));
var FIELDS_DEF_1X2 = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(ExtFIELDS_DEF[1][2]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[5]).concat(MultiSportODDS_DEF[15]);
var FIELDS_DEF_CorrectScore = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MargeOddsArray("CS"));
var FIELDS_DEF_FGLG = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[14]).concat(MultiSportODDS_DEF[127]);
var FIELDS_DEF_HTFT = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[16]);
//var FIELDS_DEF_OeTg = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(MultiSportODDS_DEF[2]).concat(MultiSportODDS_DEF[6]).concat(MultiSportODDS_DEF[12]);
var FIELDS_DEF_Oe = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[2]).concat(MultiSportODDS_DEF[12]);
var FIELDS_DEF_Tg = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[6]).concat(MultiSportODDS_DEF[126]);
var FIELDS_DEF_HTFTOE = COMMON_DEF[0].concat(FIELDS_DEF[0]).concat(COMMON_DEF[3]).concat(MultiSportODDS_DEF[128]);
var FIELDS_DEF_Outright = new Array("MatchId", "MatchCode", "ShowTime", "LeagueId", "LeagueName", "TeamName", "Changed", "Odds", "FavLeague");

/*
 * Template Id Defination Block
 * only for live mode & favorite
 */
var ARR_TMPLID_DEF = new Array();
ARR_TMPLID_DEF["1"] = new Array();
ARR_TMPLID_DEF["1"]["1"] = "UnderOver_tmpl_1";
ARR_TMPLID_DEF["1"]["2"] = "NBA_tmpl";
ARR_TMPLID_DEF["1"]["3"] = ARR_TMPLID_DEF["1"]["2"];
ARR_TMPLID_DEF["1"]["26"] = ARR_TMPLID_DEF["1"]["2"];
ARR_TMPLID_DEF["1"]["32"] = ARR_TMPLID_DEF["1"]["2"];
ARR_TMPLID_DEF["1"]["4"] = "Tennis_tmpl";
ARR_TMPLID_DEF["1"]["5"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["6"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["7"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["8"] = "Baseball_tmpl";
ARR_TMPLID_DEF["1"]["9"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["10"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["11"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["12"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["13"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["14"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["15"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["16"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["17"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["18"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["19"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["20"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["21"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["22"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["23"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["24"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["25"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["28"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["29"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["30"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["31"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["33"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["34"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["35"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["36"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["37"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["38"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["39"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["40"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["41"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["42"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["43"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["44"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["50"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["99"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["154"] = ARR_TMPLID_DEF["1"]["4"];
ARR_TMPLID_DEF["1"]["27"] = "Cricket_tmpl";
ARR_TMPLID_DEF["1"]["161"] = "Bingo_tmpl";
ARR_TMPLID_DEF["3"] = new Array();
ARR_TMPLID_DEF["3"]["1"] = "UnderOver_tmpl_3";
ARR_TMPLID_DEF["3"]["2"] = "NBA_tmpl";
ARR_TMPLID_DEF["3"]["3"] = ARR_TMPLID_DEF["3"]["2"];
ARR_TMPLID_DEF["3"]["26"] = ARR_TMPLID_DEF["3"]["2"];
ARR_TMPLID_DEF["3"]["32"] = ARR_TMPLID_DEF["3"]["2"];
ARR_TMPLID_DEF["3"]["4"] = "Tennis_tmpl";
ARR_TMPLID_DEF["3"]["5"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["6"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["7"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["8"] = "Baseball_tmpl";
ARR_TMPLID_DEF["3"]["9"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["10"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["11"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["12"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["13"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["14"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["15"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["16"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["17"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["18"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["19"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["20"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["21"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["22"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["23"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["24"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["25"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["28"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["29"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["30"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["31"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["33"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["34"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["35"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["36"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["37"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["38"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["39"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["40"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["41"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["42"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["43"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["44"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["50"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["99"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["154"] = ARR_TMPLID_DEF["3"]["4"];
ARR_TMPLID_DEF["3"]["27"] = "Cricket_tmpl";
ARR_TMPLID_DEF["3"]["161"] = "Bingo_tmpl";
ARR_TMPLID_DEF["1F"] = new Array();
ARR_TMPLID_DEF["1F"]["1"] = "UnderOver_tmpl_1F";
ARR_TMPLID_DEF["1F"]["2"] = "NBA_tmpl";
ARR_TMPLID_DEF["1F"]["3"] = ARR_TMPLID_DEF["1F"]["2"];
ARR_TMPLID_DEF["1F"]["26"] = ARR_TMPLID_DEF["1F"]["2"];
ARR_TMPLID_DEF["1F"]["32"] = ARR_TMPLID_DEF["1F"]["2"];
ARR_TMPLID_DEF["1F"]["4"] = "Tennis_tmpl";
ARR_TMPLID_DEF["1F"]["5"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["6"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["7"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["8"] = "Baseball_tmpl";
ARR_TMPLID_DEF["1F"]["9"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["10"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["11"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["12"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["13"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["14"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["15"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["16"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["17"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["18"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["19"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["20"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["21"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["22"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["23"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["24"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["25"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["28"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["29"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["30"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["31"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["33"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["34"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["35"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["36"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["37"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["38"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["39"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["40"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["41"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["42"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["43"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["44"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["50"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["99"] = ARR_TMPLID_DEF["1F"]["4"];
ARR_TMPLID_DEF["1F"]["27"] = "Cricket_tmpl";
ARR_TMPLID_DEF["1F"]["161"] = "Bingo_tmpl";
ARR_TMPLID_DEF["1H"] = new Array();
ARR_TMPLID_DEF["1H"]["1"] = "UnderOver_tmpl_1H";
ARR_TMPLID_DEF["1H"]["2"] = "NBA_tmpl";
ARR_TMPLID_DEF["1H"]["3"] = ARR_TMPLID_DEF["1H"]["2"];
ARR_TMPLID_DEF["1H"]["26"] = ARR_TMPLID_DEF["1H"]["2"];
ARR_TMPLID_DEF["1H"]["32"] = ARR_TMPLID_DEF["1H"]["2"];
ARR_TMPLID_DEF["1H"]["4"] = "Tennis_tmpl";
ARR_TMPLID_DEF["1H"]["5"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["6"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["7"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["8"] = "Baseball_tmpl";
ARR_TMPLID_DEF["1H"]["9"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["10"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["11"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["12"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["13"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["14"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["15"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["16"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["17"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["18"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["19"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["20"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["21"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["22"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["23"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["24"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["25"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["28"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["29"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["30"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["31"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["33"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["34"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["35"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["36"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["37"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["38"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["39"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["40"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["41"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["42"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["43"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["44"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["50"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["99"] = ARR_TMPLID_DEF["1H"]["4"];
ARR_TMPLID_DEF["1H"]["27"] = "Cricket_tmpl";
ARR_TMPLID_DEF["1H"]["161"] = "Bingo_tmpl";

/*
 * Template Id Defination Block
 * only for live mode & favorite
 */
var ARR_TMPLURL_DEF = new Array();
ARR_TMPLURL_DEF["1"] = new Array();
ARR_TMPLURL_DEF["1"]["1"] = "UnderOver_tmpl?form=1";
ARR_TMPLURL_DEF["1"]["2"] = "NBA_tmpl.aspx";
ARR_TMPLURL_DEF["1"]["3"] = ARR_TMPLURL_DEF["1"]["2"];
ARR_TMPLURL_DEF["1"]["26"] = ARR_TMPLURL_DEF["1"]["2"];
ARR_TMPLURL_DEF["1"]["32"] = ARR_TMPLURL_DEF["1"]["2"];
ARR_TMPLURL_DEF["1"]["4"] = "Tennis_tmpl.aspx";
ARR_TMPLURL_DEF["1"]["5"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["6"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["7"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["8"] = "Baseball_tmpl.aspx";
ARR_TMPLURL_DEF["1"]["9"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["10"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["11"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["12"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["13"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["14"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["15"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["16"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["17"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["18"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["19"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["20"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["21"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["22"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["23"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["24"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["25"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["28"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["29"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["30"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["31"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["33"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["34"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["35"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["36"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["37"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["38"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["39"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["40"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["41"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["42"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["43"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["44"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["50"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["99"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["154"] = ARR_TMPLURL_DEF["1"]["4"];
ARR_TMPLURL_DEF["1"]["27"] = "Cricket_tmpl.aspx";
ARR_TMPLURL_DEF["1"]["161"] = "Bingo_tmpl.aspx";
ARR_TMPLURL_DEF["3"] = new Array();
ARR_TMPLURL_DEF["3"]["1"] = "UnderOver_tmpl?form=3";
ARR_TMPLURL_DEF["3"]["2"] = "NBA_tmpl.aspx";
ARR_TMPLURL_DEF["3"]["3"] = ARR_TMPLURL_DEF["3"]["2"];
ARR_TMPLURL_DEF["3"]["26"] = ARR_TMPLURL_DEF["3"]["2"];
ARR_TMPLURL_DEF["3"]["32"] = ARR_TMPLURL_DEF["3"]["2"];
ARR_TMPLURL_DEF["3"]["4"] = "Tennis_tmpl.aspx";
ARR_TMPLURL_DEF["3"]["5"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["6"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["7"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["8"] = "Baseball_tmpl.aspx";
ARR_TMPLURL_DEF["3"]["9"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["10"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["11"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["12"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["13"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["14"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["15"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["16"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["17"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["18"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["19"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["20"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["21"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["22"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["23"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["24"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["25"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["28"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["29"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["30"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["31"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["33"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["34"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["35"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["36"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["37"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["38"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["39"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["40"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["41"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["42"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["43"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["44"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["50"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["99"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["154"] = ARR_TMPLURL_DEF["3"]["4"];
ARR_TMPLURL_DEF["3"]["27"] = "Cricket_tmpl.aspx";
ARR_TMPLURL_DEF["3"]["161"] = "Bingo_tmpl.aspx";
ARR_TMPLURL_DEF["1F"] = new Array();
ARR_TMPLURL_DEF["1F"]["1"] = "UnderOver_tmpl?form=1F";
ARR_TMPLURL_DEF["1F"]["2"] = "NBA_tmpl.aspx";
ARR_TMPLURL_DEF["1F"]["3"] = ARR_TMPLURL_DEF["1F"]["2"];
ARR_TMPLURL_DEF["1F"]["26"] = ARR_TMPLURL_DEF["1F"]["2"];
ARR_TMPLURL_DEF["1F"]["32"] = ARR_TMPLURL_DEF["1F"]["2"];
ARR_TMPLURL_DEF["1F"]["4"] = "Tennis_tmpl.aspx";
ARR_TMPLURL_DEF["1F"]["5"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["6"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["7"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["8"] = "Baseball_tmpl.aspx";
ARR_TMPLURL_DEF["1F"]["9"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["10"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["11"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["12"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["13"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["14"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["15"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["16"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["17"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["18"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["19"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["20"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["21"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["22"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["23"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["24"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["25"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["28"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["29"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["30"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["31"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["33"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["34"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["35"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["36"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["37"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["38"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["39"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["40"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["41"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["42"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["43"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["44"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["50"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["99"] = ARR_TMPLURL_DEF["1F"]["4"];
ARR_TMPLURL_DEF["1F"]["27"] = "Cricket_tmpl.aspx";
ARR_TMPLURL_DEF["1F"]["161"] = "Bingo_tmpl.aspx";
ARR_TMPLURL_DEF["1H"] = new Array();
ARR_TMPLURL_DEF["1H"]["1"] = "UnderOver_tmpl?form=1H";
ARR_TMPLURL_DEF["1H"]["2"] = "NBA_tmpl.aspx";
ARR_TMPLURL_DEF["1H"]["3"] = ARR_TMPLURL_DEF["1H"]["2"];
ARR_TMPLURL_DEF["1H"]["26"] = ARR_TMPLURL_DEF["1H"]["2"];
ARR_TMPLURL_DEF["1H"]["32"] = ARR_TMPLURL_DEF["1H"]["2"];
ARR_TMPLURL_DEF["1H"]["4"] = "Tennis_tmpl.aspx";
ARR_TMPLURL_DEF["1H"]["5"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["6"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["7"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["8"] = "Baseball_tmpl.aspx";
ARR_TMPLURL_DEF["1H"]["9"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["10"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["11"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["12"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["13"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["14"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["15"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["16"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["17"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["18"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["19"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["20"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["21"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["22"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["23"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["24"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["25"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["28"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["29"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["30"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["31"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["33"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["34"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["35"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["36"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["37"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["38"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["39"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["40"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["41"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["42"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["43"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["44"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["50"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["99"] = ARR_TMPLURL_DEF["1H"]["4"];
ARR_TMPLURL_DEF["1H"]["27"] = "Cricket_tmpl.aspx";
ARR_TMPLURL_DEF["1H"]["161"] = "Bingo_tmpl.aspx";
